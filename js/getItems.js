window.onload = function () {
	get_items();
}
function get_items () {
	$.ajax({
		    type : 'GET',
	        dataType : 'json',
	        success : function(person_list){
	        	console.log(person_list);
	        	make_table(person_list);
	        },
	        error : function(){
                alert("fail");
	        },
	        url : "http://localhost/receiveFresh/php/get_items.php"
	});
}
function get_state (state) {
	var str = "";
	switch (state){
		case "0" : str = "未面试";break;
		case "1" : str = "一面通过";break;
		case "2" : str = "二面通过";break;
		case "3" : str = "三面通过";break;
	}
	return str;
}
function make_table (list) {
	var tbody = document.getElementsByTagName('tbody')[0];
	
	for(var i = 0;i < list.result.length; i++){
		var tr = document.createElement("tr");
	    tr.innerHTML = "<td>" + list.result[i].id + "</td>" + 
	    "<td>" + list.result[i].name + "</td>" +
	    "<td>" + list.result[i].subject + "</td>" +
	    "<td>" + list.result[i].schedule + "</td>" +
	    "<td id=" + "statusBtn_" + list.result[i].id + ">" + get_state(list.result[i].state) + "</td>" +
	    "<td>" + "<button type='submit' class='updateBtn' id=" + list.result[i].id + "_1" + ">一面通过</button>" + "</td>" +
	    "<td>" + "<button type='submit' class='updateBtn' id=" + list.result[i].id + "_2" + ">二面通过</button>" + "</td>" +
	    "<td>" + "<button type='submit' class='updateBtn' id=" + list.result[i].id + "_3" + ">三面通过</button>" + "</td>";
	    tbody.appendChild(tr);
	}
	if(list.result.length == 0){
		alert("无导出信息");
	}
}
(function(){
  $("#item_tab").click(function(e){
    if(e.target.className == "updateBtn"){
         var id = e.target.id.split('_')[0];
         var state = e.target.id.split('_')[1];
         var tdList = e.target.parentNode;
         var changeId = "statusBtn" + "_" + id;
         var newstate = get_state(state);
         var changeRow = document.getElementById(changeId);
         changeRow.innerHTML = newstate;
         updateInfor(id,state);
    }
  });
})();
function updateInfor (id,state) {
  $.ajax({
		    type : 'GET',
	        data : {
	        	 id : id,
	             state : state
	        },
	        success : function(){
                 alert("update success");
	        },
	        error : function(){
                 alert("update error");
	        },
	        url : "http://localhost/receiveFresh/php/update.php"
	});
}

