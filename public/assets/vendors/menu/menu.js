var arraydata = [];
function getmenus() {
    $("#spinsavemenu").show()

    var cont = 0;
    $("#menu-to-edit li").each(function(index) {
        var dept = 0;
        for (var i = 0; i < $("#menu-to-edit li").length; i++) {

            var n = $(this).attr("class").indexOf("menu-item-depth-" + i);
            if (n != -1) {
                dept = i;
            }
        };
       // console.log( $(this).find(".item-edit").context.outerText);
       // alert( $(this).find(".item-edit").attr('id'));
        var textoiner = $(this).find(".item-edit").context.innerText;
	  var id = this.id.split("-");
        var textoexplotado = textoiner.split("|"); 
        var padre = 0;  
        if (!!textoexplotado[textoexplotado.length-2] && textoexplotado[textoexplotado.length-2]!= id[2]) {  
            padre = textoexplotado[textoexplotado.length-2]
        }
        arraydata.push({
            depth : dept,
            id : id[2],
            parent : padre,
            sort : cont
        })
        cont++;
    });
 actualizarmenu();
}

				function addcustommenu() {
					$("#spincustomu").show();

					$.ajax({
						data : {
							labelmenu : $("#custom-menu-item-name").val(),
							linkmenu : $("#custom-menu-item-url").val(),
							idmenu : $("#idmenu").val()
						},
                        headers: {
                            'X-CSRF-TOKEN': csrf
                        },

						url : addcustommenur,
						type : 'POST',
						success : function(response) {
							$("#spincustomu").hide();
							window.location = "";

						}
					});
				}
				function addcustompagemenu(is_route) {
					$("#spincustomu").show();
					var array = new Array();

					if(is_route)
						var sel = "route";
					else
						var sel = "page";

					alert(sel);

                    $('input[name="'+sel+'"]:checked').each(function() {
                        var obj = {
                        	url : $(this).attr('data-url'),
                        	title : $(this).attr('data-title')
						}
						array.push(obj);
                    });
					$.ajax({
						data : {
                            obj : array,
                            idmenu : $("#idmenu").val()

						},
                        headers: {
                            'X-CSRF-TOKEN': csrf
                        },

						url : addcustompagemenur,
						type : 'POST',
						success : function(response) {
							$("#spincustomu").hide();
							window.location = "";

						}
					});
				}

				function updateitem(id) {

					var label = $("#idlabelmenu_" + id).val()
					var clases = $("#clases_menu_" + id).val()
					var url = $("#url_menu_" + id).val()
					$.ajax({
						data : {
							label : label,
							clases : clases,
							url : url,
							id : id
						},
                        headers: {
                            'X-CSRF-TOKEN': csrf
                        },

						url :updateitemr,
						type : 'POST',
						success : function(response) {

							$("#menutitletemp_" + id).val(label)

							console.log("aqu llega")
							//$("#spinsavemenu").hide();
						}
					});
				}

				function actualizarmenu() {

					$.ajax({
						dataType : "json",
						data : {
							arraydata : arraydata,
							menuname : $("#menu-name").val(),
							idmenu : $("#idmenu").val()
						},
                        headers: {
                            'X-CSRF-TOKEN': csrf
                        },

						url : generatemenucontrolr,
						type : 'POST',
						success : function(response) {

							console.log("aqu llega")
							$("#spinsavemenu").hide();
						}
					});
				}

				function deleteitem(id) {
					$.ajax({
						dataType : "json",
						data : {

							id : id
						},
                        headers: {
                            'X-CSRF-TOKEN': csrf
                        },

						url :deleteitemmenur,
						type : 'POST',
						success : function(response) {

						}
					});
				}

				function deletemenu() {

					var r = confirm("Do you want to delete this menu ?");
					if (r == true) {
						$.ajax({
							dataType : "json",

							data : {

								id : $("#idmenu").val()
							},
                            headers: {
                                'X-CSRF-TOKEN': csrf
                            },

							url : deletemenugr,
							type : 'POST',
							success : function(response) {

								if (!!response.error) {
									alert(response.resp)
								}

							}
						});

					} else {
						return false;
					}

				}

				function createnewmenu() {

					if (!!$("#menu-name").val()) {
						$.ajax({
							dataType : "json",

							data : {
								menuname : $("#menu-name").val(),
							},
                            headers: {
                                'X-CSRF-TOKEN': csrf
                            },

							url :createnewmenur,
							type : 'POST',
							success : function(response) {

								window.location = menuwr+"?menu=" + response.resp

							}
						});
					} else {
						alert("Enter menu name!")
						$("#menu-name").focus();
						return false;
					}

				}
