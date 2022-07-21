<div class="content-acta" id="acta-final">
    <div class="header-acta">
    <div class="img-acta-s">
        <img src="/public/img/acta-s-img.png" alt="">
    </div>
    </div>
    <div class="items-acta">
        <div class="primero-items">
        <li><span>FECHA INGRESO </span>: <?php

use src\aplication\Utiles;

            $date = Utiles::getFecha($acta->fecha);
            echo $date;
            
           
          
           
        ?></li>
        <li id="replace"><span>AUTORIZA </span>: <input id="autoriza" type="text"> </li>
        <li><span>TIPO </span>: <?= $acta->tipo ?></li>
        <li><span>C.I/RUC </span>: <?= $acta->ci_ruc ?></li>
        </div>
        <div class="segundo-items">
        <li><span>INGRESO </span>: <?= $acta->codigo ?></li>
        <li><span>FACTURA </span>: <?= $acta->factura ?></li>
        <li><span>PROCESO </span>: <?= $acta->proceso ?></li>
        <li><span>SOLICITUD </span>: <?= $acta->solicitud?></li>
        </div>
        <li><span>PROVEEDOR </span>: <?= $proovedor->nombre . ' ' . $proovedor->apellido ?></li>
    </div>

    <div class="materiales-acta" >
        <table>
            <thead>
               <tr>
                   <th class="title" colspan="5"> Materiales de <?= $categoria->nombre ?> </th>
               </tr>
                <tr>
                    <th>ORDEN DE COMPRA</th>
                    <th>DESCRIPCIÓN</th>
                    <th>CANT.</th>
                    <th>VALOR UNITARIO</th>
                    <th>VALOR TOTAL</th>
                </tr>
            </thead>
            <tbody>
                <?php $subtotal = 0;
                foreach($materiales as $material): ?>
                    <tr>
                        <td> <?= $material->orden_compra  ?? '' ?> </td>
                        <td> <?= $material->descripcion  ?? '' ?> </td>
                        <td> <?= $material->cant  ?? '' ?> </td>
                        <td> <?= $material->valor_unitario  ?? '' ?> </td>
                        <td> <?php 
                            $valorTotal = intval($material->cant) * $material->valor_unitario;
                            $subtotal += $valorTotal;
                            echo $valorTotal;
                         ?> </td>
                    </tr>
                <?php endforeach; ?>
                <tr>
                    <td class="end" colspan="4">SUBTOTAL</td>
                    <td><?= $subtotal ?></td>
                    
                </tr>
                <tr>
                    <td class="end" colspan="4">12%</td>
                    <td id="porcentaje"> <?php $docePorciento = $subtotal * 0.12;
                         echo $docePorciento;
                    ?> </td>
                </tr>
                <tr>
                    <td class="end" colspan="4">0%</td>
                    <td>0,00</td>
                </tr>
                <tr>
                    <td class="end" colspan="4">Total</td>
                    <td id="total"> <?php $total = $subtotal + $docePorciento; echo $total; ?> </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div class="firma">
        <div>
            <?= 'Ing. ' . $user->nombre . ' ' .$user->apellido; ?> 
            <strong style="margin-top: 0.25rem; display:block;"> <?= $user->cargo; ?></strong>
        </div>
    </div>
</div>

<div class="button-pdf">
    <button role="button" id="pdf">Generar PDF</button>
</div>