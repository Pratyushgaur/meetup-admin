
import express from 'express';
import mysql from 'mysql';
import http from 'http';
import { Server as socketIo } from 'socket.io'; 
import cors from 'cors';
const con = mysql.createConnection({
    host: "localhost",
    user: "root",
    password: "",
    database:"meetupme"

  });

// Initialize express and HTTP server
const app = express();
const server = http.createServer(app);
const roomViewers = {};  // To track viewers per room
// Enable CORS
app.use(cors());

// Initialize Socket.IO
// const io = new socketIo(server, {
//   cors: {
//     origin: "*",  // Adjust to allow requests only from specific origins
//     methods: ["GET", "POST"]
//   }
// });

const io = new socketIo(server, {
  cors: {
      origin: "http://127.0.0.1:8000", // Replace with your client domain
      methods: ["GET", "POST"],
      allowedHeaders: ["my-custom-header"],
      credentials: true
  }
});

// Sample route to test the server
app.get('/', (req, res) => {
  res.send('Socket.IO server is running');
});
con.connect(function(err) {
  if (err) throw err;
  console.log("db Connected!");
  var sql  = "TRUNCATE TABLE  user_socket_ids";
  con.query(sql);
  console.log("socket ids clear");
});
// Handle Socket.IO connections
io.on('connection', (socket) => {

  console.log('A user connected:', socket.id);

  socket.on('disconnect', () => {
    console.log('A user disconnected:', socket.id);
    var sql  = "DELETE FROM user_socket_ids where socket_id = ?";
    con.query(sql, [socket.id]);
    //
    

  });
  socket.on('client-connect',(userid)=>{
    console.log('client-connet as '+userid.userid);
    var sql = "INSERT INTO user_socket_ids (userid, socket_id) VALUES ('"+userid.userid+"','"+socket.id+"')";
    con.query(sql);

  });

  socket.on('send-message-to-influencer',(data) =>{
    io.emit('send-message-to-influencer',data);
  });
  socket.on('send-message-to-user',(data) =>{
    io.emit('send-message-to-user',data);
  });
  socket.on('request-to-connect',(data) =>{
    io.emit('request-to-connect',data);
  });
  socket.on('send_audio',(audiodata)=>{
    console.log("get audio");
    io.emit('receive-user-audio',audiodata);
  });
  socket.on('user_is_offline',(data)=>{
    var sql = "update users set is_live='0' where id="+data.userId+"";
    con.query(sql);
   
  });
  socket.on('user_is_live',(data)=>{
    var sql = "update users set is_live='1' where id="+data.userId+"";
    con.query(sql);
   
  });
  // =============================
  socket.on('joinRoom', (room) => {
    let roomid = room.roomid;
    socket.join(roomid);
    console.log(`User joined room: ${roomid}`);
    
    if(room.usertype == 'receiver'){
        // Track viewers per room
        console.log(room.usertype)
        
        if (!roomViewers[roomid]) {
          roomViewers[roomid] = 0;
        }
        roomViewers[roomid]++;

        console.log(roomViewers[roomid])
        // Notify only the users in this room of the updated viewer count
        io.to(roomid).emit('viewerUpdate', { viewers: roomViewers[roomid] });

        // Notify only the users in this room of a new user joining
        io.to(roomid).emit('userJoined', { message: 'A new user has joined the stream!' });
    }

    console.log(`Socket.rooms after joining:`, socket.rooms);
    
    
  });
  socket.on('comment', (data) => {
    
    const { room, message, username } = data;  // Expecting room, message, and username from client
    console.log(`Comment in room ${room} by ${username}: ${message}`);

    // Emit the comment to the users in that specific room
    io.to(room).emit('newComment', {
        username: username,
        message: message,
        timestamp: new Date().toISOString(),
    });
});
  // socket.on('leaveRoom', (room) => {
  //       socket.leave(room);
  //       console.log(`User left room: ${room}`);

  //       // Update the viewer count
  //       if (roomViewers[room]) {
  //           roomViewers[room]--;
  //           io.to(room).emit('viewerUpdate', { viewers: roomViewers[room] });
  //           io.to(room).emit('userLeft', { message: 'A user has left the stream!' });
  //       }
  // });

  socket.on('disconnecting', function(){
    const rooms = Array.from(socket.rooms).filter(room => room !== socket.id); 
    rooms.forEach(room => {
        // Decrease the room's viewer count
        if (roomViewers[room]) {
            roomViewers[room]--;
            io.to(room).emit('viewerUpdate', { viewers: roomViewers[room] });
        }
        // Notify users in each room that someone left
        io.to(room).emit('userLeft', { message: 'A user has left the stream!' });
    });


  });




});

// Start the server
const PORT = process.env.PORT || 3000;
server.listen(PORT, () => {
  console.log(`Server is running on port ${PORT}`);
});
