<?php

include __DIR__ . '/asset/PHP/view/partials/header.php';
include __DIR__ . '/asset/PHP/view/partials/nav.php';
?>
 <div class="container-mains">
 <div class="image-mains">
        <h2 class="section-mains">NON-PROFIT ORGANIZATION</h2>
        <h1 class="title-mains">Our Mission</h1>
        <p class="description-mains">
        Our mission,rescue, protect and defend cats in distress, abandoned, lost or abused. All audiences Nature protection Prevention and protection Freedom..
        </p>
    </div>
    <style>
        body {
    font-family: Arial, sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f9f9f9;
}

.container-mains {
    color: white;
    padding: 20px;
    border-radius: 20px;
    margin: 50px auto;
}
.image-mains {
            max-width: 800px;
            margin: 0 auto;
            padding: 75px;
            background-image: url('/image/Catbanner.jpg');
        }

.section-mains{
    font-family: 'hades', sans-serif;
    font-size: 18px;
    margin: 0;
    text-transform: uppercase;
    letter-spacing: 2px;
}

.title-mains {
    color: #fff;
    font-family: 'hades', sans-serif;
    font-size: 32px;
    margin: 10px 0;
    font-weight: bold;
}

.description-mains {
    font-size: 16px;
    margin: 20px 0 0;
    line-height: 1.6;
}
 </style> 
  <div class="adoption-steps">
            <div class="step">
            <img src="/image//Visite.jpg" alt="Logo Le Refuge Relais Félin">
                <h1>Visit</h1>
                <p>You come to meet the cat to see if it really suits your family and your lifestyle.</p>
            </div>
            <div class="step">
            <img src="/image/Reservation.jpg" alt="Logo Le Refuge Relais Félin">
                <h1>Reservation</h1>
                <p>If suitable, you pay for the reservation of the cat and we agree on a time to bring it to your home.</p>
            </div>
            <div class="step">
            <img src="/image/sterilisation.jpg" alt="Logo Le Refuge Relais Félin">
                <h1>Sterilization</h1>
                <p>If the cat is not yet sterilized, we will make an appointment and inform you at the appropriate time.</p>
            </div>
            <div class="step">
            <img src="/image/Adoption.jpg" alt="Logo Le Refuge Relais Félin">
                <h1>Adoption</h1>
                <p>You pay the rest of the adoption fees, we give you his health record and you live happily with your new companion.</p>
            </div>
        </div>
        <div class="container">
            <h1>Our last emancipated cats</h1>
            <div class="cat">
            <img src="/image/Cat1.jpeg" alt="Logo Le Refuge Relais Félin">
                <h1>Puzzle and Rudis</h1>
                <p>Pour adoption</p>
            </div>
            <div class="cat">
            <img src="/image/Cat2.jpeg" alt="Logo Le Refuge Relais Félin">
                <h1>Scratch</h1>
                <p>Adopté</p>
            </div>
            <div class="cat">
            <img src="/image/Cat3.jpeg" alt="Logo Le Refuge Relais Félin">
                <h1>Rita</h1>
                <p>Adoptée</p>
            </div>
        </div>
       
<div class="footer">
        <div class="logo-footer">
            <img src="/image/ALP.png" alt="Logo Refuge Le Relais Félin" class="logo">
        </div>
        <div class="don-footer">
            <p>Help us help the kitties! We are located in the Grand Est region.</p>
            <button onclick="window.location.href='/asset/PHP/view/don.php'">DONATE</button>
        </div>
    </div>
    <hr>
    <?php
     include __DIR__ . '/asset/PHP/view/partials/foot.php';
?>
    <style>
        .adoption-steps {
          display: flex;
          justify-content: space-evenly;
          align-items: flex-start;
          flex-wrap: wrap;
          padding: 100px;
          background-color: #fff;
          margin: 20px;
      }
      
      .step {
          flex: 1 1 calc(25% - 40px);
          max-width: calc(25% - 40px);
          margin: 10px;
          text-align: center;
      }
      
      .step img {
          width: 100px;
          height: 100px;
          margin-bottom: 10px;
      }
      
      .step h1 {
          font-family: 'hades', sans-serif;
          font-size: 18px;
          color: #333;
          margin-bottom: 10px;
      }
      
      .step p {
          font-size: 14px;
          color: #666;
          line-height: 1.6;
      }
        .container {
        text-align: center;
        padding: 20px;
        background-color: #fff;
        margin: 20px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }
    
    h1 {
        font-family: 'hades', sans-serif;
        color: #333;
        font-size: 24px;
        margin-bottom: 20px;
    }
    
    .cat {
        display: inline-block;
        margin: 10px;
        text-align: center;
    }
    
    .cat img {
        width: 150px;
        height: 150px;
        border-radius: 50%;
        margin-bottom: 10px;
    }
    
    .cat h3 {
        font-size: 18px;
        color: #333;
    }
    
    .cat p {
        font-size: 14px;
        color: #666;
    }

.footer {
    display: flex;
    background-color: white;
    padding: 20px;
    color: black;
    flex-direction: column;
}

.logo-footer img {
    height: 200px;
    
}
.don-footer{
    text-align: center;
}
.don-footer button {
    background-color: black;
    color: white;
    border: none;
    border-radius: 5px;
    padding: 10px 15px;
    font-size: 16px;
    cursor: pointer;
}

.don-footer button:hover {
    background-color: lightgrey;
}
</style>
