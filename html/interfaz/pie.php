 <?php
  global $core;
  global $id;
  global $funciones;
  $opciones_secundario = $core->listarMenuPrincipal();
  ?>
<div class="centros">
  <div class="centrosInt">
    <div class="columnaPie1">
      <ul class="menuPie">
        <?php foreach($opciones_secundario as $pieMenu){ ?>
            <?php  $clase = ($pieMenu['id'] == $id)?' style="font-weight:bold"':'';?>
            <?php if($pieMenu['id'] == 2){ ?>
              <li><a href="quienes-somos" <?php echo $clase ?>><?php echo $pieMenu['titulo'] ?></a></li>
            <?php }elseif($pieMenu['id'] == 13){ ?>
              <li><a href="informacion-interes" <?php echo $clase ?>><?php echo $pieMenu['titulo'] ?></a></li>
            <?php }elseif($pieMenu['id'] == 11){ ?>
                <li><a href="informacion-gremial" <?php echo $clase ?>><?php echo $pieMenu['titulo'] ?></a></li>
            <?php }elseif($pieMenu['id'] == 337){ ?>
                <li><a href="contacto" <?php echo $clase ?>><?php echo $pieMenu['titulo'] ?></a></li>
            <?php }else{ ?>
                <li><a href="index.php?id="><?php echo $pieMenu['titulo'] ?></a></li>
            <?php } ?>
        <?php } ?>
      </ul>
      <div class="derechos">Derechos Reservados Asograsas 2014</div>
    </div>
    <div class="columnaPie2">
      <div class="logoPie"><img src="<?php echo _DOMINIO ?>images/diseno//logoPie.png"></div>
      <div class="dataEmpresa">
        <strong>Dirección: </strong> Cra 14 # 85-68 Oficina 604<br>
        <strong>Teléfono: </strong> 616 2066 ext 108<br>
      </div>
    </div>
  </div>  
</div>