@if(count($users))
    <h2 aria-level="2" class="hiddenTitle">
        Les étudiants de l'application
    </h2>
    @foreach($letters as $key=>$letter)
        <p class="text-5xl block border-t mt-16 -mb-4">{{$key}}</p>
        <div id="{{$key}}"
             class="grid mt-12 grid-cols-1 sm:grid-cols-2 sm:mr-8 lg:grid-cols-3 ml-4 flex-wrap justify-between gap-12 mr-4">
            @foreach($letter as $user)
                <section
                    class="flex flex-col justify-between border-2 rounded-xl p-4">
                    <div class="flex justify-between">
                        <div
                            class="my-4 flex flex-col rounded-xl mr-2 bg-orange-900 p-4 pt-3 relative justify-around text-center">
                            <div class="containerBookSvg mb-4 self-center"></div>
                            @if(count($user->orders) >= 1)
                                <p class="text-xl text-white font-hairline">{{$totalbooks}}</p>
                            @else
                                <p class="text-xl text-white font-hairline">0</p>
                            @endif
                        </div>
                        <div
                            class="my-4 rounded-xl bg-orange-900 p-3 pt-3 relative justify-around text-center">
                            <div class="containerGroupSvg mb-2 m-auto"></div>
                            <p class="text-xl text-white font-hairline">{{$user->group}}</p>
                        </div>
                        <div class="containerUserAvatars">
                            <div class="userContainer">
                                <img role="img" aria-label="Photo de couverture de {{$user->name}}"
                                     src="{{asset('storage')}}/{{$user->file_name ?? 'default.svg'}}"
                                     alt="Photo de profil de {{$user->name}}"/>
                            </div>

                        </div>
                    </div>
                    <div>
                        <h3 aria-level="3" class="text-2xl">
                            {{$user->name}} {{$user->surname}}
                        </h3>
                        <div class="mb-4">
                            <a href="mailto:{{$user->email}}">{{$user->email}}</a>
                        </div>
                    </div>
                    <div>
                    @if(count($user->orders) >= 1)
                        @foreach($statuses as $status)
                            <div class="flex align-center justify-center my-4 containerStatusName">
                            <img class="mr-4" src="{{asset('storage').'/orders/'.($status->file_name)}}" alt="{{$status->name}} picto">
                        <p class="pictoOrder text-xl my-4 text-center">{{$status->nameFr}}</p>
                            </div>
                        @endforeach
                    @endif
                    </div>
                    <div class="mb-4 text-center">
                        <div>
                            <a class="rounded-xl block mt-8 bg-orange-900 text-white p-3"
                               href="{{route('users.show',['user'=>$user->name,$status])}}">Plus d'informations sur
                                <span>{{$user->name}}</span></a>
                        </div>
                    </div>
                </section>
            @endforeach
        </div>
    @endforeach
@else
    <p>
        Aucun étudiant trouvé
    </p>
@endif
<nav role="navigation" aria-label="Navigation pour accéder à des utilisateurs en particuliers">
    <h2 class="hiddenTitle">
        Navigation pour utilisateurs
    </h2>
    <div class="hidden sm:inline inline-block fixed right-0 lettersContainer mr-6 text-center">
        <ul role="list">
            @foreach($letters as $key=>$letter)
                <li role="listitem">
                    <a class="text-xl letterLink" href="#{{$key}}">{{$key}}</a>
                </li>
            @endforeach
        </ul>
    </div>
</nav>
