<style>

body{
    margin-top:20px;
    background:#ebeef0;
}

.img-sm {
    width: 46px;
    height: 46px;
}

.img-xs {
    width: 32px;
    height: 32px;
}

.img-holder img {
    max-width: 100%;
    border-radius: 0;
}

.panel {
    box-shadow: 0 2px 0 rgba(0,0,0,0.075);
    border-radius: 0;
    border: 0;
    margin-bottom: 15px;
}

.panel .panel-footer, .panel>:last-child {
    border-bottom-left-radius: 0;
    border-bottom-right-radius: 0;
}

.panel .panel-heading, .panel>:first-child {
    border-top-left-radius: 0;
    border-top-right-radius: 0;
}

.panel-body {
    padding: 25px 20px;
}


.timeline {
    position: relative;
    padding-bottom: 40px;
    background-color: #ebeef0;
    color: #5f5f5f
}

.timeline:before,
.timeline:after {
    background-color: #cad3df;
    bottom: 20px;
    content: "";
    display: block;
    position: absolute
}

.timeline:before {
    left: 49px;
    top: 20px;
    width: 2px
}

.timeline:after {
    left: 47px;
    width: 6px;
    height: 6px;
    border-radius: 50%
}

.timeline-header {
    border-radius: 0;
    clear: both;
    margin-bottom: 50px;
    margin-top: 50px;
    position: relative
}

.timeline-header .timeline-header-title {
    display: inline-block;
    text-align: center;
    padding: 7px 15px;
    min-width: 100px
}

.timeline .timeline-header:first-child {
    margin-bottom: 30px;
    margin-top: 15px
}

.timeline-stat {
    width: 100px;
    float: left;
    text-align: center;
    padding-bottom: 15px
}

.timeline-entry {
    margin-bottom: 50px;
    margin-top: 5px;
    position: relative;
    clear: both
}

.timeline-entry-inner {
    position: relative
}

.timeline-time {
    display: inline-block;
    padding: 5px 3px 7px;
    margin-top: 3px;
    background-color: #ebeef0;
    color: #929292;
    font-size: .85em;
    max-width: 70px
}

.timeline-icon {
    border-radius: 50%;
    box-shadow: 0 0 0 7px #ebeef0;
    display: block;
    margin: 0 auto;
    height: 46px;
    line-height: 46px;
    text-align: center;
    width: 46px
}

.timeline-icon img {
    width: 46px;
    height: 46px;
    border-radius: 50%;
    vertical-align: top
}

.timeline-icon:empty {
    height: 10px;
    width: 10px;
    margin-top: 20px;
    background-color: #a4b4c7
}

.timeline-label {
    background-color: #fff;
    border-radius: 0;
    margin-left: 90px;
    padding: 10px;
    position: relative;
    min-height: 50px;
    border: 1px solid #e9e9e9;
        -webkit-box-shadow: 0 2px 2px 0 rgba(0,0,0,0.2),0 6px 10px 0 rgba(0,0,0,0.3);
    box-shadow: 0 2px 2px 0 rgba(0,0,0,0.2),0 6px 10px 0 rgba(0,0,0,0.3);
}

.timeline-label:before,
.timeline-label:after {
    content: "";
    display: block;
    position: absolute;
    width: 0;
    height: 0;
    left: 0;
    top: 0
}

.timeline-label:before {
    border-top: 10px solid transparent;
    border-bottom: 10px solid transparent;
    border-right: 10px solid #e6e6e6;
    margin: 15px 0 0 -10px
}

.timeline-label:after {
    border-top: 9px solid transparent;
    border-bottom: 9px solid transparent;
    border-right: 9px solid #fff;
    margin: 15px 0 0 -8px
}

.panel .timeline,
.panel .timeline-time {
    background-color: #fff
}

.panel .timeline-icon {
    box-shadow: 0 0 0 7px #fff
}

.panel .timeline-label {
    box-shadow: none;
    background-color: #f7f7f7;
    border: 1px solid #e3e3e3
}

.panel .timeline-label:before {
    border-right-color: #e3e3e3
}

.panel .timeline-label:after {
    border-right-color: #f7f7f7
}

@media (min-width:768px) {
    .two-column.timeline {
        text-align: center
    }
    .two-column.timeline:before {
        left: 50%
    }
    .two-column.timeline:after {
        left: 50%;
        margin-left: -2px
    }
    .two-column.timeline .timeline-entry {
        width: 50%;
        text-align: left
    }
    .two-column.timeline .timeline-stat {
        margin-left: -50px
    }
    .two-column.timeline .timeline-entry:nth-child(odd) {
        float: right
    }
    .two-column.timeline .timeline-entry:nth-child(odd) .timeline-label {
        margin-left: 40px
    }
    .two-column.timeline .timeline-header {
        text-align: center
    }
    .two-column.timeline .timeline-entry:nth-child(even) {
        float: left
    }
    .two-column.timeline .timeline-entry:nth-child(even) .timeline-stat {
        left: 100%;
        position: relative;
        margin-left: -50px
    }
    .two-column.timeline .timeline-entry:nth-child(even) .timeline-label {
        left: -90px;
        margin-right: -40px
    }
    .two-column.timeline .timeline-entry:nth-child(even) .timeline-label:before,
    .two-column.timeline .timeline-entry:nth-child(even) .timeline-label:after {
        left: auto;
        right: 0;
        border-right: 0 solid transparent
    }
    .two-column.timeline .timeline-entry:nth-child(even) .timeline-label:before {
        border-top: 10px solid transparent;
        border-bottom: 10px solid transparent;
        border-left: 10px solid #e6e6e6;
        margin: 15px -10px 0 0
    }
    .two-column.timeline .timeline-entry:nth-child(even) .timeline-label:after {
        border-top: 9px solid transparent;
        border-bottom: 9px solid transparent;
        border-left: 9px solid #fff;
        margin: 15px -8px 0 0
    }
}

.bg-dark, .bg-dark a {
    color: #fff;
}
.bg-dark {
    background-color: #33373a;
}

.mar-top {
    margin-top: 15px;
}
</style>

<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.3.0/css/font-awesome.min.css" rel="stylesheet">
<div class="container bootstrap snippets bootdeys">
    <div class="col-md-7 col-md-offset-2">
        <div class="panel">
            <div class="panel-body">
        		<textarea class="form-control" rows="2" placeholder="What are you thinking?"></textarea>
        		<div class="mar-top clearfix">
        			<button class="btn btn-sm btn-primary pull-right" type="submit"><i class="fa fa-pencil fa-fw"></i> Share</button>
        			<a class="btn btn-trans btn-icon fa fa-video-camera add-tooltip" href="#" data-original-title="Add Video" data-toggle="tooltip"></a>
        			<a class="btn btn-trans btn-icon fa fa-camera add-tooltip" href="#" data-original-title="Add Photo" data-toggle="tooltip"></a>
        			<a class="btn btn-trans btn-icon fa fa-file add-tooltip" href="#" data-original-title="Add File" data-toggle="tooltip"></a>
        		</div>
        	</div>
        </div>
        <div class="panel panel-body">
    		<!-- Timeline -->
    		<!--===================================================-->
    		<div class="timeline">
    
    			<!-- Timeline header -->
    			<div class="timeline-header">
    				<div class="timeline-header-title bg-success">Now</div>
    			</div>
    
    			<div class="timeline-entry">
    				<div class="timeline-stat">
    					<div class="timeline-icon"><img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="Profile picture">
    					</div>
    					<div class="timeline-time">30 Min ago</div>
    				</div>
    				<div class="timeline-label">
    					<p class="mar-no pad-btm"><a href="#" class="btn-link text-semibold">Maria J.</a> shared an image</p>
    					<div class="img-holder">
    						<img src="https://bootdey.com/img/Content/avatar/avatar1.png" alt="Image">
    					</div>
    				</div>
    			</div>
    			<div class="timeline-entry">
    				<div class="timeline-stat">
    					<div class="timeline-icon bg-danger"><i class="fa fa-building fa-lg"></i>
    					</div>
    					<div class="timeline-time">2 Hours ago</div>
    				</div>
    				<div class="timeline-label">
    					<h4 class="mar-no pad-btm"><a href="#" class="text-danger">Job Meeting</a></h4>
    					<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt.</p>
    				</div>
    			</div>
    			<div class="timeline-entry">
    				<div class="timeline-stat">
    					<div class="timeline-icon"><img src="https://bootdey.com/img/Content/avatar/avatar6.png" alt="Profile picture">
    					</div>
    					<div class="timeline-time">3 Hours ago</div>
    				</div>
    				<div class="timeline-label">
    					<p class="mar-no pad-btm"><a href="#" class="btn-link text-semibold">Lisa D.</a> commented on <a href="#">The Article</a>
    					</p>
    					<blockquote class="bq-sm bq-open">Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt.</blockquote>
    				</div>
    			</div>
    			<div class="timeline-entry">
    				<div class="timeline-stat">
    					<div class="timeline-icon bg-purple"><i class="fa fa-check fa-lg"></i>
    					</div>
    					<div class="timeline-time">5 Hours ago</div>
    				</div>
    				<div class="timeline-label">
    					<img class="img-xs img-circle" src="https://bootdey.com/img/Content/avatar/avatar2.png" alt="Profile picture">
    					<a href="#" class="btn-link text-semibold">Bobby Marz</a> followed you.
    				</div>
    			</div>
    
    			<!-- Timeline header -->
    			<div class="timeline-header">
    				<div class="timeline-header-title bg-dark">Yesterday</div>
    			</div>
    
    			<div class="timeline-entry">
    				<div class="timeline-stat">
    					<div class="timeline-icon bg-info"><i class="fa fa-envelope fa-lg"></i>
    					</div>
    					<div class="timeline-time">15:45</div>
    				</div>
    				<div class="timeline-label">
    					<h4 class="text-info mar-no pad-btm">Lorem ipsum dolor sit amet</h4>
    					<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt.</p>
    				</div>
    			</div>
    			<div class="timeline-entry">
    				<div class="timeline-stat">
    					<div class="timeline-icon bg-success"><i class="fa fa-thumbs-up fa-lg"></i>
    					</div>
    					<div class="timeline-time">13:27</div>
    				</div>
    				<div class="timeline-label">
    					<img class="img-xs img-circle" src="https://bootdey.com/img/Content/avatar/avatar3.png" alt="Profile picture">
    					<a href="#" class="btn-link text-semibold">Michael Both</a> Like <a href="#">The Article</a>
    				</div>
    			</div>
    			<div class="timeline-entry">
    				<div class="timeline-stat">
    					<div class="timeline-icon"></div>
    					<div class="timeline-time">11:27</div>
    				</div>
    				<div class="timeline-label">
    					<p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit, sed diam nonummy nibh euismod tincidunt.</p>
    				</div>
    			</div>
    		</div>
    		<!--===================================================-->
    		<!-- End Timeline -->
    	</div>
    </div>
</div>