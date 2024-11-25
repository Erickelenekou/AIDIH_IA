<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" /> 
    <title>notification utilisateur</title>
</head>
<body>
    <div class="container col col-5 text-center" id="contenant">
        <br><br>
        <div>
            <div class="row">
                <div class="col-2"></div>
                <div class="col-8" >
                    <textarea  name="" id=""></textarea>
                </div>
            </div>
            
            <div class="row">
                <div class="col-2"></div>
                <div class="col-8" id="button">
                    <div>
                         <button><i class="fa-solid fa-paperclip"></i> Joindre Pièce</button>
                    </div>
                     <div>
                         <button><i class="fa-solid fa-magnifying-glass"></i> Recherche</button>
                     </div>
                 </div>
            </div>
        </div>
        <br><br><br>
        

        <div>
            <div class="row">
                <div class="col-2"></div>
                <div class="col-8" id="reponse_ecrit" >
                </div>
            </div>
        </div>
        <br>

        <div>
            <div class="row">
                <div class="col-2"></div>
                <div class="col-8" id="reponse_vidéo" >
                </div>
            </div>
        </div>
        <br>

        <div>
            <div class="row">
                <div class="col-2"></div>
                <div class="col-8" id="reponse_carrousel" >
                </div>
            </div>
        </div>
        <br>

        <div>
            <div class="row">
                <div class="col-2"></div>
                <div class="col-8" id="reponse_audio" >
                </div>
            </div>
        </div>

        <br><br>
    </div>

    <style>
        #contenant{
            
            background-color:  rgba(138, 190, 250, 0.7) ;
            border-radius: 15px;
            margin: auto;
            
        }
       textarea{
        border: none;
        width: 100%;
        height: 150px;
        border-radius: 15px;
        background-color: white;
       }

       #button{
        display: flex;
       }
       #button div:first-child{
        margin-right: 25%;
       }
       button{
        border: none;
        background-color: white;
        border-radius: 5px;
        width: 130px;
        height: 30px;
       }

       
       #reponse_ecrit{
        height: 150px;
        border-radius: 15px;
        background-color: white;
        justify-content: center;
       }
       #reponse_vidéo, #reponse_carrousel{
        height: 180px;
        border-radius: 15px;
        background-color: white;
        justify-content: center;
       }
       #reponse_audio{
        height: 100px;
        border-radius: 15px;
        background-color: white;
        justify-content: center;
       }
    </style>
</body>
</html>