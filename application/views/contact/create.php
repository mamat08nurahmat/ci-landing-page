<?php 
$this->load->view('template/head');
?>
<!--tambahkan custom css disini-->
<?php
$this->load->view('template/topbar');
$this->load->view('template/sidebar');
?>
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        Blank page
        <small>it all starts here</small>
    </h1>
    <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
        <li><a href="#">Examples</a></li>
        <li class="active">Blank page</li>
    </ol>
</section>

<!-- Main content -->
<section class="content">

    <!-- Default box -->
    <div class="box">
        <div class="box-header with-border">
            <h3 class="box-title">Title</h3>
            <div class="box-tools pull-right">
                <button class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse"><i class="fa fa-minus"></i></button>
                <button class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove"><i class="fa fa-times"></i></button>
            </div>
        </div>
        <div class="box-body">
<!--  -->
          <!-- general form elements -->
            <!-- /.box-header -->
            <!-- form start -->
            <?php echo form_open_multipart('contact/create');?>
              <div class="box-body">

                <div class="form-group">
                  <label for="exampleInputEmail1">Nama</label>
                  <?php echo form_input('name');?>
                  <!-- <input type="text" class="form-control" id="nama" placeholder="Enter Nama"> -->
                </div>


                <div class="form-group">
                  <label for="exampleInputEmail1">Email</label>
                  <?php echo form_input('email');?>
                  <!-- <input type="text" class="form-control" id="nama" placeholder="Enter Nama"> -->
                </div>

                <div class="form-group">
                  <label for="exampleInputEmail1">Subject</label>
                  <?php echo form_input('subject');?>
                  <!-- <input type="text" class="form-control" id="nama" placeholder="Enter Nama"> -->
                </div>

                <div class="form-group">
                  <label for="exampleInputEmail1">Message</label>
                  <?php echo form_input('message');?>
                  <!-- <input type="text" class="form-control" id="nama" placeholder="Enter Nama"> -->
                </div>



              <!-- /.box-body -->

              <div class="box-footer">
              <?php echo form_submit('submit','Simpan');?>
        <?php echo anchor('contact','Kembali');?>              
                <!-- <button type="submit" class="btn btn-primary">Submit</button> -->
              </div>
              <?php echo form_close();?>
<!--  -->
        </div><!-- /.box-body -->
        <div class="box-footer">
            Footer
        </div><!-- /.box-footer-->
    </div><!-- /.box -->

</section><!-- /.content -->

<?php 
$this->load->view('template/js');
?>
<!--tambahkan custom js disini-->
<?php
$this->load->view('template/foot');
?>

<!-- <?php echo form_open_multipart('kontak/create');?>
<table>
    <tr><td>NAMA</td><td><?php echo form_input('nama');?></td></tr>
    <tr><td>NOMOR</td><td><?php echo form_input('nomor');?></td></tr>        
    <tr><td colspan="2">
        <?php echo form_submit('submit','Simpan');?>
        <?php echo anchor('kontak','Kembali');?></td></tr>
</table>
<?php
echo form_close();
?> -->