// thêm event đê cắt load
function actionDelete(event){
    event.preventDefault();
    let urlRequest = $(this).data('url')
    let that = $(this);
    //alert('clicked');

    Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!'
    }).then((result) => {
        if (result.isConfirmed) {
            //click delete call ajax xóa bảng trong database
            $.ajax({
                type: 'GET',
                url: urlRequest,
                success: function (data){
                    if(data = 200){
                        that.parent().parent().remove();
                        Swal.fire(
                            'Deleted!',
                            'Your file has been deleted.',
                            'success'
                        );
                    }

                },
                error: function (){

                }
            })
        }
    })
}
$(function (){
    // sự kiện click delete
 $(document).on('click', '.action_delete', actionDelete);
})
