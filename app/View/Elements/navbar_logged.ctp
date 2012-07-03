<div class="navbar navbar-fixed-top">
      <div class="navbar-inner">
        <div class="container">
          <a class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
            <span class="icon-bar"></span>
          </a>
          <a class="brand" href="<?php echo $this->Html->url('/') ?>">friendlist</a>
          <div class="nav-collapse">
            <ul class="nav">
              <li><a href="<?php echo $this->Html->url('/users/timeline/'.$this->Session->read('Auth.User.username')); ?>"><i class="icon-th-list icon-white"></i> Timeline</a></li>
            </ul>
            <a data-toggle="modal" href="#myModal" class="btn btn-primary pull-right"><i class="icon-pencil icon-white"></i></a>
            <div class="btn-group pull-right">
                        <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                          <i class="icon-user"></i>
                          <span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                          <li><a href="<?php echo $this->Html->url('/users/edit/').$this->Session->read('Auth.User.username');  ?>"><i class="icon-cog icon-black"></i> Edit your profile</a></li>
                          <li class="divider"></li>
                          <li><a href="<?php echo $this->Html->url('/users/search/'); ?>"><i class="icon-search icon-black"></i> Search users</a></li>
                          <li><a href="<?php echo $this->Html->url('/posts/search/'); ?>"><i class="icon-search icon-black"></i> Search games</a></li>
                          <li class="divider"></li>
                          <li><a href="<?php echo $this->Html->url('/users/logout/'); ?>"><i class=" icon-off icon-black"></i> Logout</a></li>
                        </ul>
            </div>
          </div><!--/.nav-collapse -->
        </div>
      </div>
</div>

<div id="myModal" class="modal hide" style="display: none; ">
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal">×</button>
              <h3>Add a new status</h3>
            </div>
            <div class="modal-body">

              <form class="form-inline" action="/manager/posts/add" method="post" enctype="multipart/form-data" style="margin-bottom: 0px;">
                      <select name="data[Post][status]" id="status" style="width: 100px;">
                                      <option>plays</option>
                                      <option>bought</option>
                                      <option>wants</option>
                                      <option>finished</option>
                                    </select>
                      <input type="text" name="data[Post][game_name]" class="input" id="game_name" style="width:250px;">
                      <select name="data[Post][platform_id]" id="platform" style="width: 120px;">
                                      <option>1</option>
                                    </select>
					  <button type="submit" class="btn btn-primary"><i class="icon-ok icon-white"></i></button>
					  
					  <div id="addPicture" style="margin-top: 10px;">
					  <a class="accordion-toggle" data-toggle="collapse" data-parent="addPicture" href="#picture"><i class="icon-picture"></i> Add a picture ?</a>
					  </div>
					  
					  <div id="picture" class="collapse" style="height: 0px;">
						  <input type="file" name="data[Post][imgur]" id="imgur" value="" />
					  </div>
	  
              </form>
            </div>
          
</div>