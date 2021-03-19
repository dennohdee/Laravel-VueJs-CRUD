export default {
    data() {
      return {
        
        fields: {},
        errors: {},
        loaded: true,
        action: '', 
        text: '',
        redirect: '',
        busy:false,
      }
    },  
    methods: {  
      //method for deleting 
      deleteItem: function deleteItem(path,id){
       
        var deleteadminpath = '/admin/destroy/';
        var fpath='';
        var item='';
        if(path == 'deleteadmin')
        {
          fpath=deleteadminpath;
          item="Administrator"
        }
        
       swal({
              title:'Sure to delete?',id,
              text: 'Delete '+item,
              icon: 'warning',
              type: 'warning',
              buttons:{
                confirm: {
                  text : 'Sure',
                  className : 'btn btn-success'
                },
                cancel: {
                  visible: true,
                  className: 'btn btn-info'
                }
              }
            }).then((Delete) => {
              if (Delete) {
            axios.get(fpath +id).then(function (response) {
                //this.loaded = true;
                swal({
                  title: 'Deleted!',
                  icon: 'success',
                  text: item+' has been deleted.',
                  type: 'success',
                  buttons : {
                    confirm: {
                      className : 'btn btn-success'                 
                    }
                  }             
                }).then(function(){
                  window.location.href = '';
                });
              
            })["catch"](function (error) {
             if (error.response.status === 400)
              {
              // console.log(error.response);
              
                // start fail
                swal({
                  title: 'Oops!',
                  icon: 'error',
                  text: error.response.data,
                  type: 'failure',
                  buttons : {
                    confirm: {
                      className : 'btn btn-danger'                 
                    }
                  }             
                }).then(function(){
                  window.location.href = '';
                });
                // end fail
              }
              else  
              {  
                // start fail
                swal({
                  title: 'Oops!',
                  icon: 'error',
                  text: 'An error occurred. Please try again later',
                  type: 'error',
                  buttons : {
                    confirm: {
                      className : 'btn btn-danger'                 
                    }
                  }             
                }).then(function(){
                  window.location.href = '';
                });
                // end fail
              }
              this.loaded = false;
            });
          } else {
                swal.close();
            }
        });
      },
    }
}
