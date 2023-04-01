
function hiengv(){
    
    document.getElementById("gv").style.display='block';
    document.getElementById("cngv").style.display='none';
    document.getElementById("doimk").style.display='none';
    document.getElementById("hs-edit").style.display='none';
    document.getElementById("cnhs").style.display='none';
    document.getElementById("themhs").style.display='none';
}




function logout(){
    var result = confirm("Bạn muốn đăng xuất?");
    if(result) {
         document.formlogout.submit();
    }
}

function openEdit(row){
    document.getElementById("hs-edit").style.display='none';
   document.getElementById("cnhs").style.display='block';
    var i=row.parentNode.parentNode.rowIndex;
    var ms=document.getElementById("table-hs").rows[i].cells[0].innerHTML;
    $.ajax({
        type: 'POST',
        url: '../giaovien/open-cnhs.php',
        data: {
            ms: ms,
        },
        success: function(response){
            $('#ediths').html(response);
        }
    });

}






