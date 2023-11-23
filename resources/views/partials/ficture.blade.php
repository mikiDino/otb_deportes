<div class="tournament">
    @foreach ($fixtureByDate as $fecha => $matches)
        <div class="fixtur">

            <h2 class="title">{{ \Carbon\Carbon::parse($fecha)->format('d/m/Y') }}</h2>
            <div class="round">
                @foreach ($matches as $match)
                    <div class="match">
                        {{ $match->equipoLocal->nombre }} vs {{ $match->equipoVisitante->nombre }}
                        <div class="result">
                            {{ $match->resultado_local }} - {{ $match->resultado_visitante }}
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @endforeach
</div>
