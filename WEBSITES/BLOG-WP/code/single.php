<?php get_header(); ?>

<div class="pt-24">
    
<?php include 'nav.php';?>

       <div class="container px-3 mx-auto flex flex-wrap flex-col md:flex-row items-center">
       <div class="recuadro" style="margin-bottom: 20px;margin-top: 20px;">
  <!-- Page Content -->
  <div class="container">
    <div class="row">
      <!-- Post Content Column -->
      <div class="col-lg-8">
      <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
        <!-- Title -->
        <h1 class="recuadro-titulo"><?php the_title(); ?></h1>
        <!-- Author -->
        <p class="lead">
          Por 
          <?php the_author(); ?>
        </p>
        <hr>
        <!-- Date/Time -->
        <p>Publicado <?php the_date();?> </p>
        <hr>
        <!-- Preview Image -->
        <?php the_post_thumbnail('destacada',array( 'class' => 'img-fluid rounded recuadro-imagen' )); ?>
        <hr>
        <!-- Post Content -->
        <br>
        <div class="textos">
        <?php the_content(); ?>
        </div>
        <hr>
        <?php endwhile; else : ?>
            <p>Lo siento, no hemos encontrado ningún post.</p>
        <?php endif; ?>
      </div>
    </div>
    <!-- /.row -->
  </div>
  <!-- /.container -->
           </div>
       </div>
       </div>
<?php get_footer(); ?>