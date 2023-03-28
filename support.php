<?php include('db_connect.php');?>

<div class="container-fluid">

    <div class="col-lg-12">
        <div class="responses">
            <h3 class=" text-uppercase pt-5 mb-3 ">Messages</h3>
            <div class="d-flex flex-column">
            </div>
        </div>
    </div>

</div>

<script>

    function response(id) {
        let text = $("#"+id+"response").val();
        const postObj = {
            action:"update-response",
            adminResponse:text,
            id
        }

        if(!text){
            alert("Enter a valid response");
            return;
        }

        $.post('./donor/action.php',postObj,function (data,status) {
            if(data == '1'){
                alert("Response sent successfully")
            }
            else{
                alert("Failed to send the response.")
            }
        })
    }

    function fetchData(){
        $.post('./donor/action.php',{action:'get-all-messages'},function (data,status) {
            $('.responses>.flex-column').html('');
            data.forEach(response=>{
                $('.responses>.flex-column').append(`
                                     <div class="response py-3 px-4 my-3" style="box-shadow: rgba(0, 0, 0, 0.25) 0px 0.0625em 0.0625em, rgba(0, 0, 0, 0.25) 0px 0.125em 0.5em, rgba(255, 255, 255, 0.1) 0px 0px 0px 1px inset;">
                  <div class="row">
                      <div class="form-group col">
                          <label for="" ><strong>Subject</strong></label>
                          <div>
                              ${response.subject}
                          </div>
                      </div>
                      <div class="form-group col">
                          <label for="" ><strong>Sent By</strong></label>
                          <div class="text-muted">
                              ${response.name} | ${response.email}
                          </div>
                      </div>
                  </div>
                    <div class="form-group">
                        <label for="" ><strong>Message</strong></label>
                        <div>
                            ${response.message}
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="" ><strong>Admin Response</strong></label>
                        <div class="d-flex align-items-center ">
                            <textarea name="" id="${response.id}response"  rows="3" value="${response.response}" placeholder="Enter your response" class="form-control w-50">${response.response||''}</textarea>
                            <button class="btn btn-danger ml-4" onclick="response(${response.id})">Save</button>
                        </div>
                    </div>
                </div>

                `)
            })
        },"json")
    }

    $(document).ready(function () {
        fetchData();
    })
</script>