<div class="panel panel-default">
  <div class="panel-heading clearfix">
    <h4 class="col-xs-8">Messages Settings</h4>
    <div class="pull-right">
      <div class="btn-group">
        <a class="btn btn-default" href="<?php echo URL.$settings['system']['admin'].'/messages';?>"<?php if($config['options']{4}==1)echo' data-toggle="tooltip" data-placement="left" title="Back"';?>><?php svg('back');?></a>
      </div>
      <div class="btn-group">
        <a target="_blank" class="btn btn-default info" href="https://github.com/StudioJunkyard/LibreCMS/wiki/Administration#messages-settings"<?php if($config['options']{4}==1)echo' data-toggle="tooltip" data-placement="left" title="Help"';?>><?php svg('help');?></a>
      </div>
    </div>
  </div>
  <div class="panel-body">
    <h4 class="page-header">Contact Subjects</h4>
    <div class="form-group">
      <form target="sp" method="post" action="core/add_data.php">
        <input type="hidden" name="act" value="add_subject">
        <div class="input-group col-xs-12">
          <span class="input-group-addon">Subject</span>
          <input type="text" class="form-control" name="sub" value="" placeholder="Enter a Subject...">
          <div class="input-group-addon">Email</div>
          <input type="text" class="form-control" name="eml" value="" placeholder="Enter an Email...">
          <div class="input-group-btn">
            <button class="btn btn-default add" type="submit"><?php svg('plus');?></button>
          </div>
        </div>
      </form>
      <small class="help-block text-right">If no entries are made, an input text box will be used instead of a dropdown. If email's are left blank, the messages will be sent to the site email set in <a href="<?php echo URL.$settings['system']['admin'];?>/preferences#preference-contact">Preferences</a>.</small>
    </div>
    <div id="subjects">
<?php $ss=$db->prepare("SELECT * FROM choices WHERE contentType='subject' ORDER BY title ASC");
$ss->execute();
while($rs=$ss->fetch(PDO::FETCH_ASSOC)){?>
      <div id="l_<?php echo$rs['id'];?>" class="form-group">
        <div class="input-group col-xs-12">
          <div class="input-group-addon">Subject</div>
          <input type="text" class="form-control" value="<?php echo$rs['title'];?>" onchange="update('<?php echo$rs['id'];?>','subject','title',$(this).val());" placeholder="Enter a Subject...">
          <div class="input-group-addon">Email</div>
          <input type="text" class="form-control" value="<?php echo$rs['url'];?>" onchange="update('<?php echo$rs['id'];?>','subject','url',$(this).val());" placeholder="Enter an Email...">
          <div class="input-group-btn">
            <form target="sp" action="core/purge.php">
              <input type="hidden" name="id" value="<?php echo$rs['id'];?>">
              <input type="hidden" name="t" value="choices">
              <button class="btn btn-default trash"><?php svg('trash');?></button>
            </form>
          </div>
        </div>
      </div>
<?php }?>
    </div>
    <h4 class="page-header">AutoReply Email Layout</h4>
    <div class="form-group clearfix">
      <label for="contactAutoReplySubject" class="control-label col-xs-5 col-sm-3 col-lg-2">Subject</label>
      <div class="input-group col-xs-7 col-sm-9 col-lg-10">
<?php if($user['rank']>899){?>
        <div class="input-group-btn hidden-xs">
          <button class="btn btn-default fingerprint" data-toggle="popover" data-dbgid="contactAutoReplySubject"><?php svg('fingerprint');?></button>
        </div>
<?php }?>
        <input type="text" id="contactAutoReplySubject" class="form-control textinput" value="<?php echo$config['contactAutoReplySubject'];?>" data-dbid="1" data-dbt="config" data-dbc="contactAutoReplySubject">
      </div>
      <small class="help-block text-right">Tokens: {business} {date}</small>
    </div>
    <div class="form-group clearfix">
      <label for="contactAutoReplyLayout" class="control-label col-xs-5 col-sm-3 col-lg-2">Layout</label>
      <div class="input-group col-xs-7 col-sm-9 col-lg-10">
<?php if($user['rank']>899){?>
        <div class="input-group-btn hidden-xs">
          <button class="btn btn-default fingerprint" data-toggle="popover" data-dbgid="carl"><?php svg('fingerprint');?></button>
        </div>
        <div id="carl" data-dbid="1" data-dbt="config" data-dbc="contactAutoReplyLayout"></div>
<?php }?>
        <form method="post" target="sp" action="core/update.php">
          <input type="hidden" name="id" value="1">
          <input type="hidden" name="t" value="config">
          <input type="hidden" name="c" value="contactAutoReplyLayout">
          <textarea id="contactAutoReplyLayout" class="form-control summernote" name="da"><?php echo rawurldecode($config['contactAutoReplyLayout']);?></textarea>
        </form>
      </div>
      <small class="help-block text-right">Tokens: {business} {date} {name} {subject}</small>
    </div>
  </div>
</div>
