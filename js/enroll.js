(function () {
	$("#enroll_btn").click(function(){
		submit_infor();
	});
})();
function submit_infor () {
	var id = $("#id").val();
	var name = $("#name").val();
	var subject = $("#subject").val();
	var mail = $("#mail").val();
	var schedule = $("[name='schedule']").filter(":checked")[0].id.split('_')[1]; 
	var introduce = $("#introduce").val();
	var hobby = ["Android","Ios","Web"];
	///console.log(hobby[schedule]);
	$.ajax({
		    type : 'GET',
	        dataType : 'json',
	        data : {
	        	 id : id,
	        	 name : name,
	        	 subject : subject,
	             mail : mail,
	             schedule : hobby[schedule],
	             introduce : introduce
	        },
	        success : function(person){
	        	console.log(person);
	        	alert("success");
	        },
	        error : function(){
                alert("fail");
	        },
	        url : "http://localhost/receiveFresh/php/entroll_api.php"
	});
}