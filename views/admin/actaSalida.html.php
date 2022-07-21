<div class="content-acta" id="acta-final">

<div class="header-acta-s">
    <h1>
    ACTA DE ENTREGA RECEPCION<br>
    Nro. <?= $acta->numero ?></strong>
    </h1>
</div>
<div class="direccion-acta-s">
    Chillanes, <?php

            use src\aplication\Utiles;

            $date = Utiles::getFecha($acta->fecha);
            echo $date;
    ?>
    <hr>
</div>
<div class="notificacion-acta-s">
    SUMINISTROS DE <?php 
    echo strtoupper($categoria->nombre) ?> SUJESTO(S) A CONTROL 
    ADMINISTRATIVO Y FINANCIERO Y MAS DISPOSICIONES DEL MINISTERIO
    DE EDUCACIÓN - DIRECCIÓN DISTRITAL 02D02 <br>
    CHILLANES - EDUCACIÓN
    <br>
    <hr>
</div>
<div class="mensaje-acta-s">
    En el Cantón Chillanes, Provincia Bolívar, en el Departamento Administrativo de la Dirección Distrital
    02D02 Chillanes - Educación, a los <?php $day = Utiles::getFecha($acta->fecha);
                echo preg_split('/ /', $day)[1];
            ?> dias del mes de <?php $day = Utiles::getFecha($acta->fecha);
            echo preg_split('/ /', $day)[3];
        ?> del <?php $day = Utiles::getFecha($acta->fecha);
        echo preg_split('/ /', $day)[5];
    ?> el(la) Ing. <?= $emisor->nombre . ' ' . $emisor->apellido ?> con C.I Nº- <?= $emisor->cedula?>, <?= $emisor->cargo?>,
    quien entrega <strong>SUMINISTROS DE <?php 
    echo strtoupper($categoria->nombre) ?></strong> a el(la)  Lic. <?=$receptor->nombre . ' ' . $receptor->apellido?> con
    C.I Nº- <?= $receptor->cedula?> <strong><?=$receptor->cargo?> DE LA <?= $institucion->nombre?></strong> con codigo
    Amie <?= $institucion->id ?>, de acuerdo al siguiente detalle: 

</div>

<div class="item-acta-s">
    <table>
        <thead>
            <tr>
               <th> DESCRIPCIÓN</th>
               <th>CANTIDAD</th>
               <th>VALOR UNITARIO</th>
               <th>VALOR TOTAL</th>
            </tr>
        </thead>
        <tbody>
            <?php $subtotal= 0; foreach($materiales as $material): ?>

                <tr>
                    <td> <?= $material->descripcion ?> </td>
                    <td> <?= $material->cant ?> </td>
                    <td> <?= $material->valor_unitario ?> </td>
                    <td> <?php 
                            $valorTotal = intval($material->cant) * $material->valor_unitario;
                            $subtotal += $valorTotal;
                            echo $valorTotal;
                         ?></td>
                </tr>
            
            <?php endforeach; ?>
            <tr>
                    <td class="end" colspan="3">SUBTOTAL</td>
                    <td><?= $subtotal ?></td>
                    
                </tr>
                <tr>
                    <td class="end" colspan="3">12%</td>
                    <td id="porcentaje"> <?php $docePorciento = $subtotal * 0.12;
                         echo $docePorciento;
                    ?> </td>
                </tr>
                <tr>
                    <td class="end" colspan="3">Total</td>
                    <td id="total"> <?php $total = $subtotal + $docePorciento; echo $total; ?> </td>
                </tr>
        </tbody>
    </table>
</div>

<div class="ultimatum">
    Para constancia de lo acordado y fe de conformidad y aceptación. Suscriben en dos ejemplares
    de igual tenor y efecto las personas que intervienen en esta diligencia:
</div>

<div class="firmas-acta-s">
    <div>
        <p><strong>RECIBE CONFORME</strong> </p>
        <p>Lic. <?=$receptor->nombre . ' ' . $receptor->apellido?> <br>
        <strong><?=$receptor->cargo?> </strong>
        </p>
    </div>
    <div>
        <p><strong>ENTREGA CONFORME</strong></p>
        <p>Ing. <?= $emisor->nombre . ' ' . $emisor->apellido ?><br>
            <strong><?= $emisor->cargo?></strong>
        </p>
    </div>
</div>
</div>
<div class="button-pdf">
    <button role="button" id="pdf">Generar PDF</button>
</div>