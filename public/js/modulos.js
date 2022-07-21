
/**
 * @author Dorian Armijos
 * @param {*} param0 
 * @param {*} pares array [{key:nombre,value:valor}] || true
 * @param {*} formDatos Fomulario Completo
 */

export default function xhrRequest({method,url,asyn=true},pares=null,formDatos=null){
    const xhr = new XMLHttpRequest();
    xhr.open(method,url,asyn);
    if(pares != null && pares != true){
        const form = new FormData();
        
        pares.forEach(element => {
            const keys = Object.keys(element);
            keys.forEach(valor => {
                form.append(valor,element[valor]);
            })
            
        });

        xhr.send(form);
    }else
    if(pares != null && formDatos != null){
        const form = new FormData(formDatos);
        xhr.send(form);
    }else{
        xhr.send(pares);
    }
    
    return xhr;

}