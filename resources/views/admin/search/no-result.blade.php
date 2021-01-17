@extends('layouts.app')
@section('content')
    <section class="flex justify-center flex-col items-center">
        <svg version="1.1" class="mb-6" id="Calque_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
             viewBox="0 0 224.1 224.1" style="enable-background:new 0 0 224.1 224.1;" xml:space="preserve">
<style type="text/css">
    .st0{fill-rule:evenodd;clip-rule:evenodd;fill:#28384C;stroke:#28384C;stroke-miterlimit:10;}
    .st1{fill-rule:evenodd;clip-rule:evenodd;fill:#DD352E;}
    .st2{fill-rule:evenodd;clip-rule:evenodd;fill:#EBBA16;}
    .st3{fill-rule:evenodd;clip-rule:evenodd;fill:#23A24D;}
    .st4{fill-rule:evenodd;clip-rule:evenodd;fill:#8E5128;stroke:#8E5128;stroke-miterlimit:10;}
    .st5{fill:#FFFFFF;}
</style>
            <g>
                <path class="st0" d="M224.1,46.4H0V13.5C0,6,6,0,13.5,0h197.1c7.5,0,13.5,6,13.5,13.5V46.4z"/>
                <path class="st1" d="M15.5,15.5H31V31H15.5V15.5z"/>
                <path class="st2" d="M46.4,15.5h15.5V31H46.4V15.5z"/>
                <path class="st3" d="M77.3,15.5h15.5V31H77.3V15.5z"/>
                <path class="st4" d="M210.6,224.1H13.5c-7.5,0-13.5-5.8-13.5-13V45.5h224.1v165.6C224.1,218.3,218.1,224.1,210.6,224.1z"/>
            </g>
            <g>
                <g>
                    <path class="st5" d="M117,134.8L155.7,96c1.4-1.4,1.4-3.6,0-4.9c-1.4-1.4-3.6-1.4-4.9,0L112,129.9L73.3,91.1
			c-1.4-1.4-3.6-1.4-4.9,0c-1.4,1.4-1.4,3.6,0,4.9l38.8,38.8l-38.8,38.8c-1.4,1.4-1.4,3.6,0,4.9c0.7,0.7,1.6,1,2.5,1s1.8-0.4,2.5-1
			l38.8-38.8l38.8,38.8c0.7,0.7,1.6,1,2.5,1s1.8-0.4,2.5-1c1.4-1.4,1.4-3.6,0-4.9L117,134.8z"/>
                </g>
            </g>
</svg>

        <h2 aria-level="2" class="hiddenTitle">
            Pas de résultats
        </h2>
        <p>
            Mince ! Je n'ai rien trouver avec cette recherche, réssayez avec un <span id="inputCta"
                                                                                      class="underline cursor-pointer">autre champ de recherche ci-dessus</span>
            ou <a href="{{route('users.index')}}" class="underline">retourner à la page d'accueil</a>
        </p>
    </section>
@endsection
@section('scripts')
    <script type="text/javascript">window.addEventListener("load",function(){var e=document.getElementById("formSearch");document.getElementById("inputCta").addEventListener("click",function(){e.focus();});});
    </script>
@endsection
