<div class="white-area-content">

<div class="db-header clearfix">
    <div class="page-header-title"> <span class="glyphicon glyphicon-send"></span> <?php echo lang("ctn_518") ?></div>
    <div class="db-header-extra form-inline">
    <?php $default_order = null; ?>
    <?php if($views->num_rows() > 0) : ?>
      <?php
        $current_view = lang("ctn_642");
        $default_order = null;
        if($this->user->info->custom_view > 0) {
          foreach($views->result() as $r) {
            if($r->ID == $this->user->info->custom_view) {
              $current_view = $r->name;
              $default_order = $r->order_by;
              $default_order_type = $r->order_by_type;
            }
          }
        }
      ?>
         <div class="btn-group">
          <div class="dropdown">
        <button class="btn btn-info btn-sm dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
          <?php echo $current_view ?>
          <span class="caret"></span>
        </button>
        <ul class="dropdown-menu" aria-labelledby="dropdownMenu2">
            <li><a href="<?php echo site_url("jobs/active_view/0/" . $page) ?>"><?php echo lang("ctn_643") ?></a></li>
          <?php foreach($views->result() as $r) : ?>
            <li><a href="<?php echo site_url("jobs/active_view/" . $r->ID . "/" . $page) ?>"><?php echo $r->name ?></a></li>
          <?php endforeach; ?>
        </ul>
      </div>
      </div>
    <?php endif; ?>

         <div class="btn-group">
    <div class="dropdown">
  <button class="btn btn-default btn-sm dropdown-toggle" type="button" id="dropdownMenu1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
    <?php echo lang("ctn_462") ?>
    <span class="caret"></span>
  </button>
  <ul class="dropdown-menu" aria-labelledby="dropdownMenu1">
      <li><a href="<?php echo site_url("jobs/" . $page) ?>"><?php echo lang("ctn_600") ?></a></li>
    <?php foreach($categories->result() as $r) : ?>
      <li><a href="<?php echo site_url("jobs/".$page."/" . $r->ID) ?>"><?php echo $r->name ?></a></li>
    <?php endforeach; ?>
  </ul>
</div>
</div>

 <div class="form-group has-feedback no-margin">
<div class="input-group">
<input type="text" class="form-control input-sm" placeholder="<?php echo lang("ctn_336") ?>" id="form-search-input" />
<div class="input-group-btn">
    <input type="hidden" id="search_type" value="0">
        <button type="button" class="btn btn-info btn-sm dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
<span class="glyphicon glyphicon-search" aria-hidden="true"></span></button>
        <ul class="dropdown-menu small-text" style="min-width: 90px !important; left: -90px;">
          <li><a href="#" onclick="change_search(0)"><span class="glyphicon glyphicon-ok" id="search-like"></span> <?php echo lang("ctn_337") ?></a></li>
          <li><a href="#" onclick="change_search(1)"><span class="glyphicon glyphicon-ok no-display" id="search-exact"></span> <?php echo lang("ctn_338") ?></a></li>
          <li><a href="#" onclick="change_search(2)"><span class="glyphicon glyphicon-ok no-display" id="title-exact"></span> <?php echo lang("ctn_425") ?></a></li>
          <li><a href="#" onclick="change_search(3)"><span class="glyphicon glyphicon-ok no-display" id="title2-exact"></span> <?php echo lang("ctn_481") ?></a></li>
          <li><a href="#" onclick="change_search(4)"><span class="glyphicon glyphicon-ok no-display" id="title3-exact"></span> <?php echo lang("ctn_550") ?></a></li>
          <li><a href="#" onclick="change_search(5)"><span class="glyphicon glyphicon-ok no-display" id="title4-exact"></span> <?php echo lang("ctn_551") ?></a></li>
          <li><a href="#" onclick="change_search(6)"><span class="glyphicon glyphicon-ok no-display" id="title5-exact"></span> <?php echo lang("ctn_552") ?></a></li>
          <li><a href="#" onclick="change_search(7)"><span class="glyphicon glyphicon-ok no-display" id="title6-exact"></span> <?php echo lang("ctn_611") ?></a></li>
        </ul>
      </div><!-- /btn-group -->
</div>
</div>

     <a href="<?php echo site_url("jobs/add") ?>" class="btn btn-primary btn-sm"><?php echo lang("ctn_553") ?></a>
</div>
</div>

<div class="table-responsive">
<table id="job-table" class="table table-bordered table-hover table-striped small-text">
<thead>
<tr class="table-header"><td><?php echo lang("ctn_611") ?></td><td><?php echo lang("ctn_11") ?></td><td><?php echo lang("ctn_428") ?></td><td><?php echo lang("ctn_391") ?></td><td><?php echo lang("ctn_462") ?></td><td><?php echo lang("ctn_481") ?></td><td><?php echo lang("ctn_550") ?></td><td><?php echo lang("ctn_463") ?></td><td><?php echo lang("ctn_52") ?></td></tr>
</thead>
<tbody>
</tbody>
</table>
</div>


</div>

<script type="text/javascript">
$(document).ready(function() {

   var st = $('#search_type').val();
    var table = $('#job-table').DataTable({
        "dom" : "<'row'<'col-sm-12'tr>>" +
                "<'row'<'col-sm-5'i><'col-sm-7'p>>",
      "processing": false,
        "pagingType" : "full_numbers",
        "pageLength" : 15,
        "serverSide": true,
        "orderMulti": false,
        "order": [
        <?php if($default_order != null) : ?>
          [<?php echo $default_order ?>, "<?php echo $default_order_type ?>"]
        <?php else : ?>
        	[6, "desc"]
        <?php endif; ?>
        ],
        "columns": [
        null,
        null,
        null,
        null,
        null,
        { "orderable": false },
        { "orderable": false },
        null,
        { "orderable": false }
    ],
        "ajax": {
            url : "<?php echo site_url("jobs/job_page/" . $page . "/" . $catid) ?>",
            type : 'GET',
            data : function ( d ) {
                d.search_type = $('#search_type').val();
            }
        },
        "drawCallback": function(settings, json) {
        $('[data-toggle="tooltip"]').tooltip();
      }
    });
    $('#form-search-input').on('keyup change', function () {
    table.search(this.value).draw();
});

} );
function change_search(search) 
    {
      var options = [
        "search-like", 
        "search-exact",
        "title-exact",
        "title2-exact",
        "title3-exact",
        "title4-exact",
        "title5-exact",
        "title6-exact",
      ];
      set_search_icon(options[search], options);
        $('#search_type').val(search);
        $( "#form-search-input" ).trigger( "change" );
    }

function set_search_icon(icon, options) 
    {
      for(var i = 0; i<options.length;i++) {
        if(options[i] == icon) {
          $('#' + icon).fadeIn(10);
        } else {
          $('#' + options[i]).fadeOut(10);
        }
      }
    }
</script>
