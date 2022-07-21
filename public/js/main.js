import xhrRequest from './modulos.js';
/**
 * Funcianalidad de el menu en forma de hamburguesa
 */
(function (){
   const menu_desplegable= document.getElementById('menu-desplegable');
   if(menu_desplegable == null) return;
    const hamburger = document.getElementById('hamburger');
    const hijoBurger = hamburger.querySelector('div');

    hamburger.addEventListener('click' , mostrar);

    function mostrar(e) {
        e.preventDefault();
        if(menu_desplegable.classList.length >= 1){
            menu_desplegable.classList.remove('hide');
            hijoBurger.classList.add('salida');
        }else{
            menu_desplegable.classList.add('hide');
            hijoBurger.classList.remove('salida');
        }
    }



})();

/**
 * funcionalidad que permite agregar materiales por media de un input:number
 */

(function (){
   const cantidad = document.getElementById('cantidad-materiales');
   if(cantidad == null) return;
   const buttonAgg = document.getElementById('agregar-proovedor');
   const contenedor = document.querySelector('.contenedor-materiales');
   const form = document.querySelector('form');
   const opciones_proovedor = document.querySelector('.opciones-proovedor');
   const buttonAggCategoria = document.getElementById('agg-categoria');
   const opciones_categoria = document.querySelector('.opciones-categoria');
   cantidad.addEventListener('input', agregar);
   

   function agregar(){
       if(cantidad.value == 0 || cantidad.value == '') {
        contenedor.innerHTML = ``;
        return;
       } 
        contenedor.innerHTML = ``;
        for (let index = 0; index < cantidad.value; index++) {
           const label = document.createElement('label');
           const input = document.createElement('input');
           label.textContent = `Ingrese la orden de compra del material ${index+1}`;
           input.setAttribute('type','text');
           input.setAttribute('name',`material${index}[orden]`);
           input.setAttribute('required','');
           input.setAttribute('placeholder','Orden de compra');
           contenedor.append(label);
           contenedor.append(input);
        }
        for (let index = 0; index < cantidad.value; index++) {
            const label = document.createElement('label');
           const input = document.createElement('input');
           label.textContent = `Ingrese la descripcion del material ${index+1}`;
           input.setAttribute('type','text');
           input.setAttribute('name',`material${index}[descripcion]`);
           input.setAttribute('placeholder','Descripcion del material');
           input.setAttribute('required','');
           contenedor.append(label);
           contenedor.append(input);
            
        }
        for (let index = 0; index < cantidad.value; index++) {
            const label = document.createElement('label');
           const input = document.createElement('input');
           label.textContent = `Ingrese la cantidad del material ${index+1}`;
           input.setAttribute('type','number');
           input.setAttribute('name',`material${index}[cantidad]`);
           input.setAttribute('required','');
           input.setAttribute('min', '1');
           contenedor.append(label);
           contenedor.append(input);
        }
        for (let index = 0; index < cantidad.value; index++) {
            const label = document.createElement('label');
           const input = document.createElement('input');
           label.textContent = `Ingrese el valor unitario ${index+1}`;
           input.setAttribute('type','number');
           input.setAttribute('name',`material${index}[valor]`);
           input.setAttribute('step','0.01');
           input.setAttribute('min', '0.1');
           input.setAttribute('required','');
           contenedor.append(label);
           contenedor.append(input);
        }
        contenedor.innerHTML += `
            <button id="ok"> Seguir </button>
        `;
        contenedor.classList.add('form-externo');
        if(contenedor.classList.length > 2){
            contenedor.classList.remove('hide');
        }
        funcionalidad();
   }

   function funcionalidad(){
       contenedor.addEventListener('click', e => {
          
          e.preventDefault();
          e.stopPropagation();
          contenedor.classList.add('hide');
          verMateriales();
       });
       Array.from(contenedor.children).forEach(element => {
           if(element.tagName == "BUTTON"){
                element.addEventListener('click', e => {
                    e.preventDefault();
                    verMateriales();
                })
           }else{
            element.addEventListener('click', e => {
                e.preventDefault();
                e.stopPropagation();
            })
           }
        
    });
   }

   function verMateriales(){
    if(form.querySelectorAll('span').length >= 1){
        return;
    }
    contenedor.classList.add('hide');
    const span = document.createElement('span');
    span.textContent = 'Ver Materiales Ingresados';
    span.className = "vinculo";
    span.addEventListener('click', e  => {
        e.preventDefault();
        contenedor.classList.remove('hide');
    });
    form.append(span);
   }   
   
   /**
    * Funcionalidad para agregar un proovedor
    */
   buttonAgg.addEventListener('click',aggProovedor);

   function aggProovedor(e){
    e.preventDefault();
    opciones_proovedor.innerHTML = ``;
    const div = document.createElement('div');
    div.innerHTML = `
    <form action="" method="post">
    <label for="">Ingrese Nombre de la Empreso / Persona</label>
    <input type="text" name="nombres" required>
    <label for="">Ingrese Apellidos</label>
    <input type="text" name="apellidos" placeholder="Opcional...">
    <label for="">Ingrese el telefono</label>
    <input type="text" name="telefono" placeholder="Opcional">
    <label for="">Ingrese la Direccion</label>
    <input type="text" name="direccion" placeholder="Opcional">
    <button id="add-new-proovedor">Agregar</button>
    </form>
    `;
    div.className= "formus";
    div.classList.add('fixed');
    opciones_proovedor.append(div);
    addProovedor();
   }
   function addProovedor(){
       const button = document.getElementById('add-new-proovedor');
       button.addEventListener('click', e  => {
           e.preventDefault();
           const form_inputs = e.composedPath()[1].children;
           if(form_inputs[1].value == '' || form_inputs[3] == ''){
               alert('Uno de los campos esta vacio verifique nuevamente');
           }else{
               const newForm = opciones_proovedor.querySelector('form');
                const xhr = xhrRequest({method:'POST', url:'/add/proovedor'},true,newForm);

                xhr.onreadystatechange = () => {
                    if(xhr.status == 200 && xhr.readyState == XMLHttpRequest.DONE){
                        alert(JSON.parse(xhr.response).done);
                        window.location.reload();
                    }
                }
           }
       })
   }

   /**
    * 
    * Funcionalidad para agregar una categoria
    * agregar/categoria
    * 
    */

        buttonAggCategoria.addEventListener('click' , e => {
            
                e.preventDefault();
                opciones_categoria.innerHTML = ``;
                const div = document.createElement('div');
                div.innerHTML = `
                    <label> Ingrese un nombre de categoria </labe>
                    <input type="text" name="nombre"/>
                    <button id="agreagar-new-categoria">Agregar</button>
                `;

                div.className= "formus";
                div.classList.add('fixed');
                opciones_categoria.append(div);
                aggCategoriaXHR();
        })

        function aggCategoriaXHR(){
            const button = document.getElementById('agreagar-new-categoria');
            button.addEventListener('click' , e => {
                e.preventDefault();
                const input = opciones_categoria.querySelector('input');
                if(input.value == ''){
                    alert('El campo del nombre no puede ir vacio');
                    return;
                }else{
                    const datos = [{nombre:input.value}];
                    const xhr = xhrRequest({method:'POST',url:'/agregar/categoria'},datos,null);
                    xhr.onreadystatechange = () => {
                        if(xhr.status == 200 && xhr.readyState == XMLHttpRequest.DONE){
                                alert(JSON.parse(xhr.response).done);
                                window.location.reload();
                        }
                    }
                }

            })
        }

})();


/**
 * 
 * Funcionalidad para generar el PDF de Acta de entrada
 * Funcionalidad para generar el PDF de Acta de Salida
 * 
 * 
 */

(function(){
    const button = document.getElementById('pdf');
    if(button == null) return;
    button.addEventListener("click",convertPDF );
    function convertPDF(){
    let nombre = prompt('Ingrese un nombre para el archivo a descargar');
    if(nombre.length == 0) {
        alert("No se descargo el archivo");
        return
    }
    const HTML = document.getElementById('acta-final');
        html2pdf()
        .set({magin: 1,
              filename: nombre,
              image: {
                  type: 'jpeg',
                  quality: 0.98
              },
              html2canvas: {
                  scale: 3,
                  letterRendering: true,
              },
              jsPDF: {
                  unit: "in",
                  format: "a4",
                  orientation: 'portrait'
              },
              pagebreak: { mode: ['css', 'legacy']
            }
        })
        .from(HTML)
        .save()
        .catch(e => console.log(e))
        .finally()
        .then(alert("Se ha descargado correctamente"));
    }
})();


/***
 * 
 * 
 * Funcionalidad de input al genrar la acta
 * 
 * 
 ****
 */


 (function(){
    const acta_final = document.getElementById('acta-final');
    if(acta_final == null) return;
    document.addEventListener('keydown' , e  => {
        if(e.key == 'Enter'){
           agregandoAutoriza();            
        }
    });


    function agregandoAutoriza(){
      const autoriza = document.getElementById('autoriza');
      const replace = document.getElementById('replace');
      if(autoriza.value == ''){
          alert('El autoriza no puede ir vacio');
          return;
      }

      const span = document.createElement('label');
      const res = document.createTextNode(autoriza.value);
      span.append(res);
      replace.replaceChild(span,autoriza);
    }
 })();
 /**
  * 
  * Funcionalidad para generar los materiales a partir de una categoria
  * 
  * 
  */

 (function(){
        
        const institucion = document.getElementById('institucion');
        if(institucion == null) return;
        const opciones_materiales = document.querySelector('.opciones-material');
        const categorias = document.getElementById('categoria-acta');
        const children = Array.from(categorias.children);
        let num = 1;
        categorias.addEventListener('click' , e => {
            e.preventDefault();
            if(num % 2 == 0 ){
                if(categorias.value == '#') {
                    opciones_materiales.innerHTML = ``;
                    return;
                }
                const xhr  = xhrRequest({method:'GET', url:`/get/materiales?id=${categorias.value}`},null,null);
                xhr.onreadystatechange = () => {
                    if(xhr.status == 200 && xhr.readyState == XMLHttpRequest.DONE){
                        console.log(xhr.response);
                        pictureMateriales(JSON.parse(xhr.response).materiales);
                    }
                }
            }
            num++;
        })
        

        function pictureMateriales(array){
            opciones_materiales.innerHTML = ``;
            const div = document.createElement('div');
            div.className = "items-materiales";
            let i = 0;
            array.forEach(elemento => {
                if(elemento.cant !=0){
                    div.innerHTML += `
                    <section>
                    <label> ${elemento.descripcion} </label>
                    <input type="checkbox" name="material${i+1}[id]" value="${elemento.orden_compra}" id="material-generado${i+1}" />
                    <input type="number" name="material${i+1}[cant]" min="1" max="${elemento.cant}" id="material-generado${i+1}input"/>
                    </section>
                    `;
                }
                i++;
            })

            opciones_materiales.append(div);

            
        }   

 })();

 /**
  * 
  * Funcionalidad de ingresar una nueva institucion 
  * 
  * 
  */

 (function(){
    const buttonInstituion = document.getElementById('agg-new-institucion');
    if(buttonInstituion == null)  return;
    const opciones_insticiones = document.querySelector('.opciones-instituciones');
    buttonInstituion.addEventListener('click',pictureFormInsticiones)
    function pictureFormInsticiones(e){
        e.preventDefault();
        const div = document.createElement('div');
        div.innerHTML = `
        <form action="" method="post">
        <label for="">Ingrese el codigo AMIE</label>
        <input type="text" name="codigo" required>
        <label for="">Ingrese Nombre de la Institucion</label>
        <input type="text" name="nombre" required>
        <button id="add-new-institucion">Agregar</button>
        </form>
        `;
        div.className= "formus";
        div.classList.add('fixed');
        opciones_insticiones.append(div);
        agredaInstitucion(div.querySelector('form'));
    }   

    function agredaInstitucion(form){
        const button = document.getElementById('add-new-institucion');
        button.addEventListener('click', eventoAGG);

        function eventoAGG(e){
            e.preventDefault();
            const input = form.querySelector('input');
            if(input.value == ''){
                alert('El campo nombre no puede ir vacio');
            }else{
                const xhr = xhrRequest({method:'POST',url:'/add/institucion'},true,form);
                xhr.onreadystatechange = () => {
                    if(xhr.status == 200 && xhr.readyState == XMLHttpRequest.DONE){
                        console.log(xhr.response);
                        alert(JSON.parse(xhr.response).done);
                        window.location.reload();
                    }
                }
            }
        }
    }

    

 })();



 /**
  * 
  * 
  * Funcionalidad para genrar los lideres institucionales a partir de la institucion
  * 
  * 
  */



 (function(){
     const select = document.getElementById('institucion');
     const envio  = document.getElementById('lider-institucion');
        if(select == null) return;
        let num = 1;
        select.addEventListener('click' , e => {
            e.preventDefault();
            if(num % 2 == 0 ){
                if(select.value == '#') {
                    envio.innerHTML =``;
                    return;
                }
                const xhr  = xhrRequest({method:'GET', url:`/get/instituciones?id=${select.value}`},null,null);
                xhr.onreadystatechange = () => {
                    if(xhr.status == 200 && xhr.readyState == XMLHttpRequest.DONE){
                        envio.innerHTML =``;
                        pictureLideres(JSON.parse(xhr.response).lideres);
                    }
                }
                
            }
            num++;
        })

        function pictureLideres(array){
            array.forEach(lider => {
                const option = document.createElement('option');
                option.setAttribute('value',lider.cedula);
                option.textContent = lider.nombre + ' '+ lider.apellido;
                envio.append(option); 
            })
        }
 })();


 /**
  * 
  * 
  * Funcionalidad para ingresar nuevos lideres de intituciones
  * 
  * 
  */

 (function(){
     const lider = document.getElementById('lider-persona');
    if(lider == null) return;
    lider.addEventListener('click',viwFormLider);

    function viwFormLider(e){
        e.preventDefault();
        const select = document.getElementById('institucion');
        const div = document.createElement('div');
        const opciones_lider = document.querySelector('.opciones-lider');
        div.innerHTML = `
        <form action="" method="post">
        <label for="">Ingrese la cedula </label>
        <input type="text" name="cedula" required>
        <label for="">Ingrese los Nombre </label>
        <input type="text" name="nombres" required>
        <label for="">Ingrese los Apellidos</label>
        <input type="text" name="apellidos" required>
        <label for="">Ingrese el Cargo</label>
        <input type="text" name="cargo" required>
        <input type="hidden" name="institucion" value="${select.value}"/>
        <button id="add-new-lider">Agregar</button>
        </form>
        `;
        div.className= "formus";
        div.classList.add('fixed')
        opciones_lider.append(div);
        aggLider(div.querySelector('form'));
    }

    function aggLider(form){
        const button = document.getElementById('add-new-lider');
        button.addEventListener('click', eventoAGG);
        function eventoAGG(e){
            e.preventDefault();
            const inputs = Array.from(form.querySelectorAll('input'));
            const vr = inputs.every( input => input.value != '');

            if(vr){
              
                if(inputs[inputs.length-1].value == '#'){
                    alert('Primero debe selecionar una institucion en la parte superior');
                    const opciones_lider = document.querySelector('.opciones-lider');
                    opciones_lider.innerHTML = ``;
                    return;
                }
                const xhr = xhrRequest({method:'POST',url:'/add/lideres'},true,form);
                    xhr.onreadystatechange = () => {
                        if(xhr.status == 200 && xhr.readyState == XMLHttpRequest.DONE){
                            alert(JSON.parse(xhr.response).done);
                            window.location.reload();
                        }
                    }
            }else{
                alert('Uno de los campos esta vacio');
            }
            
            
            
        }

    }

 })();

 /**
  * 
  * 
  * 
  * Funcionalidad para enviar todo hacia back-end para generar la acta de entrega 
  * 
  * 
  * 
  * 
  */

 (function(){
    const next = document.getElementById('next');
    if(next == null) return;
    const formus = document.querySelector('.formus');
    const form = formus.querySelector('form');
    next.addEventListener('click', verificacion);

    function verificacion(e){
        e.preventDefault();
        const selects = Array.from(form.querySelectorAll('select'));
        let ver = selects.every(select => select.value != '#');
        if(!ver){
            alert('Por favor complete todos los campos para continuar');
        }else{
            let materiales = [];
            let newForm = [{materiales:[]}];
            const ckeckboxs = Array.from(formus.querySelectorAll('input:checked'));
            
                newForm.push({institucion:selects[0].value});
                newForm.push({lider: selects[1].value});
                newForm.push({categoria: selects[2].value});          
            ckeckboxs.forEach(ckeck => {
                const cant = document.getElementById(`${ckeck.getAttribute('id')}input`);
                if(cant.value == ''){
                    alert('Existe un material sin determinar una cantidad desmarquelo o ingrese una cantida');
                    return;
                }
                materiales.push({id:ckeck.getAttribute('value'),cant: cant.value});
            });
            materiales = JSON.stringify(materiales);
            newForm[0].materiales = materiales;

            const xhr = new xhrRequest({method:'POST',url:'/view/acta-salida'},newForm);
                xhr.onreadystatechange = () =>{
                    if(xhr.status == 200 && xhr.readyState == XMLHttpRequest.DONE){
                        
                        window.location.href = "/view/acta-entrega?id="+JSON.parse(xhr.response).codigo.trim()
                    }
                } 
            
          
        }
        
    }
 })();