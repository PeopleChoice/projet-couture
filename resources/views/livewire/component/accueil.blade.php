
<div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
    <div class="max-w-full">
        <p style="font-weight: bold;text-align: center" class="font-black">INVITATION PRIVÉE</p>
    </div>
    <div class="max-w-full rounded overflow-hidden shadow-lg">
        <img class="w-full" src="https://restaurantdupalaisroyal.com/wp-content/uploads/2020/02/Restaurant_du_Palais_Royal_RDC_11_GdeLaubier.jpg" alt="Mountain">
        
    </div>
    
</div>
<br>
<div class="bg-white overflow-hidden shadow-xl sm:rounded-lg px-4 py-4">
    <div class="max-w-full">
        <div>
          
            <iframe
            width="560"
            height="450"
            style="border:0"
            loading="lazy"
            allowfullscreen
            {{-- src="https://www.google.com/maps/embed/v1/place?key=AIzaSyB04ra5XgKw4uefGzv2j5JzuqYEV4cyOdc&q=LA+MARINA,France" --}}
            src="{{$pay}}"
            >
            </iframe>
        </div>
        <br>
        {!! QrCode::size(70)->generate('sante serigne saliou'); !!}
        <br>
        <p style="text-align: center;font-weight: bold;font-size: 22">INVITATION</p>
        <p style="text-align: center;font-weight: bold;font-size: 22">100% GRATUITE</p>
        <p style="text-align: center;font-size: 12">Valable de 1 à 6 personnes</p>
        <br>
        <br>
        <p style="text-align: center;font-size: 12">Physaro vous invite à la présentation de ses derniers produits innovants suivi d'un repas offert pour vous et vos amis.</p>
        <br><br>
        <p style="font-size: 20px;text-align: center">Plus d'informations au </p>
        <p style="font-size: 20px;text-align: center;font-weight: bold">01 87 64 19 00 </p>
        <p style="font-size: 10px;text-align: center">(prix d'un appel local) </p>
        <br>
        <br>
        
        <p style="text-align: center;font-size: 12">Invitation réservée au plus de 35 ans uniquement, nous ne disposons pas d'espace enfant</p>
        <br><br>
        
        <p style="text-align: center;font-size: 10">PHYSARO / N° Siren 753 667 781 - www.physaro.fr.</p>
        <br><br>
       
        <p style="text-align: center;font-size: 10">Pour le bon déroulement de l'évènement, passé l'horaire indiqué nous ne serons plus en mesure de vous accueillir. Photos non contractuelles. Repas offert uniquement à la date et au lieu de l'animation indiqués sur votre courrier. L'invitation peut être annulèe en cas de force majeure.</p>
        <br>
      
      
    </div>
</div>
