
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

// Enable CORS
app.use(cors());

// Initialize Socket.IO
const io = new socketIo(server, {
  cors: {
    origin: "*",  // Adjust to allow requests only from specific origins
    methods: ["GET", "POST"]
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
    console.log(data);
    io.emit('request-to-connect',data);
  });
});

// Start the server
const PORT = process.env.PORT || 3000;
server.listen(PORT, () => {
  console.log(`Server is running on port ${PORT}`);
});
