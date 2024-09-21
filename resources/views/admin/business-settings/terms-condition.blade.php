@extends('admin.layout.app')
@section('title', 'Terms Condition')
@section('content')
<div class="container">

    <!-- BREADCRUMB -->
    <div class="page-meta">
        <nav class="breadcrumb-style-one" aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Business Settings</a></li>
                <li class="breadcrumb-item active" aria-current="page">Term & Condition</li>
            </ol>
        </nav>
    </div>
    <!-- /BREADCRUMB -->
    <form action="{{route('admin.business-setup.term.condition.submit')}}" method="post">
        @csrf
        <div id="autosaving" class="row layout-spacing">
            <div class="col-lg-12">
                <div class="statbox widget box box-shadow">
                    <div class="widget-header">
                        <div class="row">
                            <div class="col-xl-12 col-md-12 col-sm-12 col-12">
                                <h4> Term & Condition </h4>
                            </div>
                        </div>
                    </div>
                    <div class="widget-content widget-content-area">
                        <textarea name="term_condition" id="inp_editor1">{{ $data->term_condition ?? null}}</textarea>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-12 mt-1">
            <div class="form-group text-end">
                <button type="submit" class="btn btn-secondary">Submit</button>
            </div>
        </div>
    </form>
</div>
@endsection

@push('js')
<script>
    $(document).ready(function() {
        var editor2cfg = {}
        
        editor2cfg.toolbar = "mytoolbar";
        editor2cfg.toolbar_mytoolbar = "{bold,italic,underline}|{fontname,fontsize}|{insertorderedlist,insertunorderedlist,inserthorizontalrule}|{forecolor,backcolor}|{justifyleft,justifycenter,justifyright,justifyfull}|removeformat" +
            "#{undo,redo,fullscreenenter,fullscreenexit}";

        var editor2 = new RichTextEditor("#inp_editor1", editor2cfg);
    });
</script>
@endpush