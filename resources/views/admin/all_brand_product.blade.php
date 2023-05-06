@extends('admin_layout')
@section('admin_content')
    <div class="table-agile-info">
  <div class="panel panel-default">
    <div class="panel-heading">
      Liệt kê thương sản phẩm
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
            <th style="width:20px;">
              <label class="i-checks m-b-none">
                <input type="checkbox"><i></i>
              </label>
            </th>
            <th>Tên thương</th>
            <th>Hiển thị</th>
            
            <th style="width:30px;"></th>
          </tr>
        </thead>
        <tbody>
          @foreach ($all_brand_product as $key => $brand_pro)
          <tr>
            <td><label class="i-checks m-b-none"><input type="checkbox" name="post[]"><i></i></label></td>
            <td>{{$brand_pro->brand_name}}</td>
            <td><span class="text-ellipsis">
            <?php
              if($brand_pro->brand_status==0){
                ?>
                <a href="/unactive-brand-product/{{$brand_pro->brand_id}}" class="fa fa-thumbs-down"></a>
             <?php
              }else{
              ?>  
              <a href="/active-brand-product/{{$brand_pro->brand_id}}" class="fa fa-thumbs-up"></a>
              <?php
              }
              ?>
            </span></td>
   
            <td>
              <a href="/edit-brand-product/{{$brand_pro->brand_id}}" class="active" ui-toggle-class=""><i class="fa fa-pencil-square-o text-success text-active"></i></a>
               <a href="/delete-brand-product/{{$brand_pro->brand_id}}" onclick="return confirm('Bạn có muốn xóa không')" class="active" ui-toggle-class=""><i class="fa fa-times text-danger text"></i></a>
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