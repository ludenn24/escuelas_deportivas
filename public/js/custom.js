function BuscarCursos(selectObject) {
  document.getElementById("obj_deporte").disabled = false;
  var idvalor = selectObject.value;
  return $.ajax({
      type:"get",
      url: 'cursos/sede',
      data: {
          sede : idvalor,
      },
      success: function(data){
          $('#obj_deporte div').remove();
          $.each(data,function(i,item){
                $("#obj_deporte").append(""+
                "<div class='col-md-12'>"+
                "<div class='row'>"+
                "<div class='funkyradio'>"+
                "<div class='col-md-3 col-3 col-xs-12'>"+
                "<div class='funkyradio-success'>"+
                "<input "+
                "type='checkbox' "+
                "name='curso[]' "+
                "id='curso_"+item.id_curso+"' "+
                "class='checkbox' "+
                "value='"+item.id_curso+"' "+ 
                "onclick='ActiveHorario(this)'>"+
                "<label for='curso_"+item.id_curso+"'>"+item.nombre+"</label>"+
                "</div>"+
                "</div>"+
                "<div class='col-md-9 col-5 col-xs-offset-1 col-md-offset-0 col-xs-10'>"+
                "<select style='display:none' "+
                "class='form-control form-select' id='curso_hora_"+item.id_curso+"' "+
                "id='distrito'"+
                " value=''"+
                "</select>"+
                "</div>"+
                "</div>"+
                "</div>"+
                "</div>");

                $.ajax({
                    url: 'horario/curso',
                    type:'get',     
                    data: {
                        curso : item.id_curso,
                    },
                    beforeSend: function(e){
                        //$('#load').addClass('load');
                    },
                    success: function(data){
                        //var b = JSON.parse(data);
                        //var cont = 0;
                        //$('#li'+item.idcategory).append('<ul class="treeview-menu" id="ul'+item.idcategory+'">');
                        $('#curso_hora_'+item.id_curso).append('<option value="">:: Frecuencia | Horarios | Edades ::</option>');
                        $.each(data,function(v,value){
                            $('#curso_hora_'+item.id_curso).append('<option value="'+value.id_horario+'">'+item.frecuencia+" | "+value.horario+" | "+value.edades+  '</option>');
                            //cont++;
                        });
                    },
                    error: function(){
                        $('#load').removeClass('load');
                    }
                });
          });
      },
      error: function(){
      }
  });
};
    
function ActiveHorario(selectObject) {
    var idcurso = selectObject.value;
    var y = document.getElementById("curso_hora_"+idcurso);
    if (y.style.display === "none") {
        y.style.display = "block";
        y.setAttribute("name", "horario[]");
    } else {
        y.style.display = "none";
        y.setAttribute("name", "");
    }

};