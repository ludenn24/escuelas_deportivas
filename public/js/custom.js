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
                "value='"+item.id_curso+"' "+ 
                "onclick='ActiveHorario(this)'>"+
                "<label for='curso_"+item.id_curso+"'>"+item.nombre+"</label>"+
                "</div>"+
                "</div>"+
                "<div class='col-md-4 col-4 col-xs-12'>"+
                "<input style='display:none' class='form-control' name='frecuencia[]' id='fre_"+item.id_curso+"' "+
                "type='text' disabled='disabled' "+
                "value='"+item.frecuencia+"' >"+ 
                "</div>"+
                "<div class='col-md-5 col-5 col-xs-12'>"+
                "<select style='display:none' "+
                "class='form-control form-select ' id='curso_hora_"+item.id_curso+"' name='horario[]' "+
                "id='distrito'"+
                " value=''"+
                " name='distrito'"+
                "data-content='Usted debe seleccionar el distrito.'>"+
                "<option value=''>:: Horarios | Edades ::</option>"+
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
                        $.each(data,function(v,value){
                            $('#curso_hora_'+item.id_curso).append('<option value="'+value.horario+'">'+value.horario+" | "+value.edades+  '</option>');
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
    var x = document.getElementById("fre_"+idcurso);
    var y = document.getElementById("curso_hora_"+idcurso);
    if (x.style.display === "none" || y.style.display === "none") {
        x.style.display = "block";
        y.style.display = "block";
    } else {
        x.style.display = "none";
        y.style.display = "none";
    }

};