@extends('admin_layout')
@section('admin_content')
    <div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt kê mã giảm giá
    </div>
    
    <?php
	$message = Session()->get('message');
	if($message){
		echo '<span class="tex-aler">'.$message.'</span>';
		Session()->put('message',null);
	}
	?>
    
    <div class="table-responsive">
      <table class="table table-striped b-t b-light">
        <thead>
          <tr>
           
            <th>Tên mã giảm giá</th>
            <th>Mã giảm giá</th>
            <th>Số lượng giảm giá</th>
            <th>Điều kiện giảm giá</th>
            <th>Số giảm</th>
            
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @foreach ($voucher as $key => $vou)
          <tr>
            
            <td>{{$vou->voucher_name}}</td>
             <td>{{$vou->voucher_code}}</td>
              <td>{{$vou->voucher_time}}</td>
              <td><span class="text-ellipsis">
            <?php
              if($vou->voucher_condition==1){
                ?>
               Giảm theo %
             <?php
              }else{
              ?>  
              Giảm theo tiền
              <?php
              }
              ?>
            </span></td>
            <td><span class="text-ellipsis">
            <?php
              if($vou->voucher_condition==1){
                ?>
               Giảm {{$vou->voucher_number}} %
             <?php
              }else{
              ?>  
              Giảm {{$vou->voucher_number}} K
              <?php
              }
              ?>
            </span></td>
            <td>
             
               <a href="/delete-voucher/{{$vou->voucher_id}}" onclick="return confirm('Bạn có muốn xóa không')" class="active" ui-toggle-class=""><i class="fa fa-times text-danger text"></i></a>
            </td>
          </tr>
        @endforeach
        </tbody>
      </table>
    </div>
    <footer class="panel-footer">
      <div class="row">
        
        <div class="col-sm-5 text-center">
          <small class="text-muted inline m-t-sm m-b-sm">showing 20-30 of 50 items</small>
        </div>
        <div class="col-sm-7 text-right text-center-xs">                
          <ul class="pagination pagination-sm m-t-none m-b-none">
            <li><a href=""><i class="fa fa-chevron-left"></i></a></li>
            <li><a href="">1</a></li>
            <li><a href="">2</a></li>
            <li><a href="">3</a></li>
            <li><a href="">4</a></li>
            <li><a href=""><i class="fa fa-chevron-right"></i></a></li>
          </ul>
        </div>
      </div>
    </footer>
  </div>
</div>
        
         
        </div>
@endsection