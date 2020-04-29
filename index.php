<!DOCTYPE HTML>
<html>
    <head>
        <title>LiveQuestion</title>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" >
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css">
        <script src="https://code.jquery.com/jquery-3.3.1.min.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>
        <link href="https://fonts.googleapis.com/css?family=Lato" rel="stylesheet">
        <link rel="stylesheet" href="./assets/style-home-page.css">
    </head>
    <body data-spy="scroll" data-target=".navbar" data-offset="60">
        <nav class="navbar navbar-expand-md navbar-default navbar-dark sticky-top justify-content-right" id="bgColor">
            <p class="textesv">Saint Vincent BTS 1</p>
            <button class="navbar-toggler" type="btton" data-toggle="collapse" data-target="#myNavbar">
                <i class="fas fa-bars fa-lg"></i>
            </button>
            <div class="collapse navbar-collapse justify-content" id="myNavbar">
                <ul class="nav nav-pills navbar-nav">
                    <li class="nav-item"><a class="nav-link dropdown-toggle" href="#">Lien 1</a></li>
                    <li class="nav-item"><a class="nav-link dropdown-toggle" href="#">Lien 2</a></li>
                    <li class="nav-item"><a class="nav-link dropdown-toggle" href="#">Lien 3</a></li>
                    <li class="nav-item"><a class="nav-link dropdown-toggle" href="#">Lien 4</a></li>
                </ul>
            </div>
            <a href="./connexion.php"><button class="buttonConnexion">Connexion</button></a>
        </nav>
        <section id="header" class="container-fluid">
            <div class="row" class="col-md-10">
                <div class="textePhotoHeader">
                    <img  class="screenShot" src="images/step-1.png">
                    <div class="textHeader">
                        <h1>Lorem Ipsum dolor sit amet</h1>
                        <span> Sed elit libero, accumsan et volutpat id, aliquam
                            tristique odio. Mauris sed lectus a justo malesuada 
                            dapibus. Morbi eleifend tellus nisi, sed ullamcorper 
                            mi tincidunt faucibus. Mauris justo tortor, tempor
                            ut odio in, dictum malesuada eros. </span>
                        <div>
                            <button >Bouton CTA</button>
                        </div>
                    </div>
                </div>
                <div class="bulle"></div>
            </div>
        </section>
        <section id="sectionIcon">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-4">
                        <div class="blocIcon">
                            <img src="images/i1.png">
                            <p> Suits Your Style</p>
                            <span> Drogon sed ut perspiciatis unde omnis iste error sit voluptatem accusantium doloremque laudantium, totam eaque Arya.</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="blocIcon">
                            <img src="images/i2.png">
                            <p>Ut posuere molestie</p>
                            <span> Drogon sed ut perspiciatis unde omnis iste error sit voluptatem accusantium doloremque laudantium, totam eaque Arya.</span>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="blocIcon">
                            <img src="images/i3.png">
                            <p>Vestibulum ut erat consectetur</p>
                            <span> Drogon sed ut perspiciatis unde omnis iste error sit voluptatem accusantium doloremque laudantium, totam eaque Arya.</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="sectionSlideLien">
            <div class="container-fluid">
                <div class="row">
                    <div class="col">
                        <h2>Aenan magna odio</h2>
                        <p>Orem ipsum dolor sit amet, consectetur adipiscing elit. Maecenas mattis sapien elit, a rhoncus lorem ullamcorper eu. Nullam vitae egestas eros. Duis congue viverra nunc et vulputate. </p>
                        <ul class="nav nav-pills justify-content-center">
                            <li class="active"><a data-toggle="pill" href="#home">Lien 1</a></li>
                            <li><a data-toggle="pill" href="#menu1">Lien 2</a></li>
                            <li><a data-toggle="pill" href="#menu2">Lien 3</a></li>
                        </ul>

                        <div class="tab-content">
                            <div id="home" class="tab-pane active">
                                <div class="texte-image1">
                                    <h2 id="titre-texte1">Prasent vitae velit tristique <span class="underline">old alos</span></h2>
                                    <p id="paragraphe-texte1">Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                </div>
                                <div class="boutonCommentaire1">
                                    <a ><button class="btn btn-light"><img src="images/persona3.jpg" style="border-radius: 175px; width: 50px;"><span class="texte-bouton">"proin vel dolor dictum, congue tellus at, lobortis neque"</span></button></a>
                                </div>
                                <div class="image-lien1">
                                    <img src="images/step-2.jpg">
                                </div>
                            </div>
                            <div id="menu1" class="tab-pane fade">
                                <div class="image-lien2">
                                    <img  src="images/step-3.jpg">
                                </div>
                                <div class="texte-image2">
                                    <h2 id="titre-texte2">Duis et eros lorem.</h2>
                                    <p id="paragraphe-texte2">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium,totam rem aperiam, eaque ipsa.</p>
                                </div>
                                <div class="boutonCommentaire">
                                    <a ><button class="btn btn-light"><img src="images/persona2.jpg" style="border-radius: 175px; width: 50px;"><span class="texte-bouton">"aliquam gravida magna ut"</span></button></a>
                                </div>
                            </div>
                            <div id="menu2" class="tab-pane fade">
                                <div class="image-lien2">
                                    <img src="images/step-4.png">
                                </div>
                                <div class="texte-image2">
                                    <h2 id="titre-texte2">Curabitur gravida metus at mi malesuada.</h2>
                                    <p id="paragraphe-texte2">Sed ut perspiciatis unde omnis iste natus error sit voluptatem accusantium doloremque laudantium,totam rem aperiam, eaque ipsa.</p>
                                </div>
                                <div class="boutonCommentaire">
                                    <a ><button class="btn btn-light" style="margin-right: 13%"><img src="images/persona1.jpg" style="border-radius: 175px; width: 50px;"><span class="texte-bouton">"malesuada"</span></button></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="sectionBoutonPlay">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <img class="boutonPlay" src="images/iplay.png">
                        <p class="textBouton">"Nulla venenatis magna fringilla"</p>
                    </div>
                </div>
            </div>
        </section>
        <section id="partieReseau" >
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class=" blocReseau">
                            <h2>Etiam laot, <span class="underline">alique sceleris</span></h2>
                            <p>Sed ut  perspiciatis unde omnis iste natus error sit volupattem 
                                accusantium doloremque lauudantium, totam rem aperiam, eaque ipsa.</p>
                            <div class=" col-sm-12 boutonReseau">
                                <div class="  premiereLigne">
                                    <a ><button class="btn btn-light"><img src="images/marque1.jpg"><span>Kyan boards</span></button></a>
                                    <a ><button class="btn btn-light"><img src="images/marque2.jpg"><span>Atica</span></button></a>
                                    <a><button class="btn btn-light"><img src="images/marque3.jpg"><span>Treva</span></button></a>
                                    <a ><button class="btn btn-light"><img src="images/marque4.jpg"><span>Kanba</span></button></a>
                                </div>
                                <div class="col-sm-12 deuxièmeLigne">
                                    <a ><button class="btn btn-light"><img src="images/marque5.jpg"><span>Triv Forms</span></button></a>
                                    <a ><button class="btn btn-light"><img src="images/marque7.jpg"><span>Aven</span></button></a>
                                    <a ><button class="btn btn-light"><img src="images/marque6.jpg"><span>Utosia</span></button></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="faq">
            <div class="container">
                <h2>FAQ</h2>
                <span class="titreSlogan">Set ut perspicacis unde omnis iste natus error sit voluptatern accusantium doloremque laudantium, totam rem aperiam, eaque ipsa.</span>
                <ul>
                    <li>
                        <input type="checkbox" checked>
                        <i></i>
                        <h3>Can I upgrade later on ?</h3>
                        <p class="pinterFaq">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestiae debitis iusto voluptatum doloribus rem, qui nesciunt labore tempore fugit iste deserunt incidunt error provident repudiandae laudantium quo ipsa unde perspiciatis, nihil autem distinctio! Deserunt, aspernatur.</p>
                    </li>
                    <li>
                        <input type="checkbox" checked>
                        <i></i>
                        <h3>Can I port my data from another provider ?</h3>
                        <p class="pinterFaq">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sapiente quasi, quia provident facere recusandae itaque assumenda fuga veniam dicta earum dolorem architecto facilis nisi pariatur.</p>
                    </li>
                    <li>
                        <input type="checkbox" checked>
                        <i></i>
                        <h3> Are my food photos stored forever in the cloud ?</h3>
                        <p class="pinterFaq" >Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nam quas placeat assumenda mollitia magni consequatur dolorum, quod nihil distinctio aperiam officia alias! Voluptate dolore ex officiis sit, magnam non a, eligendi pariatur aut, earum dolores tenetur ipsam id illo deleniti. Laudantium deserunt eaque ipsam voluptatum consequuntur voluptatibus sed minima ad accusamus debitis eos similique laboriosam, molestiae? Consequatur neque tempore quis. Eligendi, in ut aspernatur esse nesciunt libero.</p>
                    </li>
                    <li>
                        <input type="checkbox" checked>
                        <i></i>
                        <h3>what's the real cost?</h3>
                        <p class="pinterFaq">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nam quas placeat assumenda mollitia magni consequatur dolorum, quod nihil distinctio aperiam officia alias! Voluptate dolore ex officiis sit, magnam non a, eligendi pariatur aut, earum dolores tenetur ipsam id illo deleniti. Laudantium deserunt eaque ipsam voluptatum consequuntur voluptatibus sed minima ad accusamus debitis eos similique laboriosam, molestiae? Consequatur neque tempore quis. Eligendi, in ut aspernatur esse nesciunt libero.</p>
                    </li>
                    <li>
                        <input type="checkbox" checked>
                        <i></i>
                        <h3>who foots the bill for that?</h3>
                        <p class="pinterFaq">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nam quas placeat assumenda mollitia magni consequatur dolorum, quod nihil distinctio aperiam officia alias! Voluptate dolore ex officiis sit, magnam non a, eligendi pariatur aut, earum dolores tenetur ipsam id illo deleniti. Laudantium deserunt eaque ipsam voluptatum consequuntur voluptatibus sed minima ad accusamus debitis eos similique laboriosam, molestiae? Consequatur neque tempore quis. Eligendi, in ut aspernatur esse nesciunt libero.</p>
                    </li>
                    <li>
                        <input type="checkbox" checked>
                        <i class="fas fa-trash"> </i><i class="fas fa-edit"></i>
                        <h3>Can my company request a custom plan?</h3>
                        <p class="pinterFaq">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nam quas placeat assumenda mollitia magni consequatur dolorum, quod nihil distinctio aperiam officia alias! Voluptate dolore ex officiis sit, magnam non a, eligendi pariatur aut, earum dolores tenetur ipsam id illo deleniti. Laudantium deserunt eaque ipsam voluptatum consequuntur voluptatibus sed minima ad accusamus debitis eos similique laboriosam, molestiae? Consequatur neque tempore quis. Eligendi, in ut aspernatur esse nesciunt libero.</p>
                    </li>
                </ul>
            </div>
            <div class="container">
                <div class="d-flex justify-content-center">
                    <div class="background-textefaq">
                        <div class="texteFaq">
                            <p class="ptexteFaq">Still have unanswered questions ?<span class="spantexteFaq">Get in touch</span></p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
        <section id="footer">
            <div class="container">
                <div class=".d-none .d-sm-block .d-md-none">
                    <div class="screenShotFooter">
                        <img src="images/links.jpg">
                    </div>
                    <div class="trait"></div>
                    <div class="texteFooter">
                        <p>© 2019 Page protected by reCAPTACHA and subject to Google's </p>
                        <p class="textBold"> Privacy Policy</p>
                        <p> and</p>
                        <p class="textBold"> Terms of Service</p>
                    </div>
                </div>
            </div>
        </section>
        <!--script pour la nav-->
        <script>
            $(window).scroll(function(){
                $('nav').toggleClass('scrolled', $(this).scrollTop() >800);
            });
        </script>
    </body>
</html>