jQuery(document).on('click','.delete_emp',function(e){
	e.preventDefault();
	var empId = jQuery(this).attr('emp-id');
	if(confirm('Are you sure you want to delete employee?')){
		$.ajaxSetup({
			headers: {
			  'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
			}
		});

		jQuery.ajax({
         	url: base_url + '/emp/delete_emp',
          	method: 'post',
          	data: {'_token':_globalObj ,'empId': empId },
          	success: function(result){
          		if (result['success']) {
          			location.reload();
          		}
            	
          	}
      });
	}
	return false;
})


  /*jQuery(window).on('load', function(){
    alert('123');
  });*/
    var url = window.location;

    // for sidebar menu entirely but not cover treeview
    jQuery('ul.sidebar-menu li a').filter(function() {
       return this.href == url;
    }).parent().addClass('active');

    // for sidebar menu entirely which has treeview class
    jQuery('ul.treeview-menu li a').filter(function() {
      return this.href == url;
    }).closest('.treeview').addClass('active');

    
    jQuery(document).ready(function () {     
    
    setTimeout(function() {
        $('.employeeSuccess').slideUp("slow");
    }, 5000);

    //console.log(base_url + '/storage/defaultimages/loading.gif');

    $.ajaxSetup({
      headers: {
          'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
      }
  });

    var table = $('#empDataTable').DataTable( {
        "paging": true,
        "lengthChange": true,
        "responsive": true,
        "searching": true,
        "autoWidth": true,
        "processing": true,
        "serverSide" : true,
        "pageLength" : 5,
        "lengthMenu": [ 5,10, 25, 50, 75, 100 ],
        "columnDefs": [
            /*{"visible": false, "targets": [6]},*/
            //{"className":"text-right","targets": 5 },
            {"orderable": false, "targets": [0]},
        ],

        "ajax": {
            url: base_url+'/get-employess-data',
            type: "POST"
        },
        "order": [[5, 'desc']],

        
    } );
});


jQuery("#image_name").change(function(){
    
    jQuery('.imgPreview').html("");
    var total_file=document.getElementById("image_name").files.length;
    //console.log(total_file);
    for(var i=0;i<total_file;i++)
    {
      console.log(event.target.files[i].type);
      if(event.target.files[i].type == 'image/png' || event.target.files[i].type == 'image/svg' || event.target.files[i].type == 'image/jpeg' || event.target.files[i].type == 'image/jpg'){
        jQuery('.imgPreview').append("<img src='"+URL.createObjectURL(event.target.files[i])+"'>");
      }
    }

  });

jQuery(document).on('click','.show_list_user',function () {
    alert('click');
    return false;
})