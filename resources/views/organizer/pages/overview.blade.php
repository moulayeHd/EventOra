@php
    $trendValues = $revenueTrend->pluck('value');
    $maxTrend = max(1, $trendValues->max() ?: 1);
    $trendCount = max(1, $revenueTrend->count() - 1);
    $chartPoints = $revenueTrend->values()->map(function ($point, $index) use ($maxTrend, $trendCount) {
        $x = round(($index / $trendCount) * 600, 1);
        $y = round(220 - (($point['value'] / $maxTrend) * 170), 1);

        return $x.','.$y;
    })->implode(' ');
    $areaPoints = '0,240 '.$chartPoints.' 600,240';
    $mixColors = ['#8b5cf6', '#0ea5e9', '#d946ef', '#94a3b8'];
    $mixTotal = max(1, $ticketMix->sum('sold'));
    $mixCursor = 0;
    $mixSegments = [];

    foreach ($ticketMix as $index => $mix) {
        $size = round(($mix['sold'] / $mixTotal) * 100, 2);
        $mixSegments[] = $mixColors[$index % count($mixColors)].' '.$mixCursor.'% '.($mixCursor + $size).'%';
        $mixCursor += $size;
    }

    if (empty($mixSegments)) {
        $mixSegments[] = 'rgba(148, 163, 184, .45) 0% 100%';
    }
@endphp

<section class="organizer-panel is-active" data-section-panel="overview">
    <div class="organizer-stats-grid">
        <x-organizer.stat-card icon="calendar" label="Evenements" :value="number_format($stats['events'])" :trend="'+' . $stats['live_events'] . ' live'" tone="violet" />
        <x-organizer.stat-card icon="ticket" label="Billets vendus" :value="number_format($stats['tickets_sold'])" :trend="'+' . number_format($stats['available_tickets']) . ' dispo.'" tone="cyan" />
        <x-organizer.stat-card icon="wallet" label="Revenus" :value="number_format($stats['revenue'], 0, ',', ' ').' FCFA'" :trend="'+' . $stats['conversion'] . '%'" tone="emerald" />
        <x-organizer.stat-card icon="users" label="Participants" :value="number_format($stats['participants'])" :trend="$stats['reservations'] . ' reservations'" tone="pink" />
    </div>

    <div class="organizer-dashboard-grid">
        <article class="organizer-card organizer-card--wide organizer-reveal">
            <div class="organizer-card__head">
                <div>
                    <h2>Revenue trend</h2>
                    <p>Revenus mensuels sur les 6 derniers mois</p>
                </div>
                <div class="organizer-segment">
                    <button class="is-active" type="button">6M</button>
                    <button type="button">YTD</button>
                    <button type="button">All</button>
                </div>
            </div>

            <div class="organizer-line-chart">
                <svg viewBox="0 0 600 240" preserveAspectRatio="none" role="img" aria-label="Courbe des revenus">
                    <defs>
                        <linearGradient id="overviewChartFill" x1="0" x2="0" y1="0" y2="1">
                            <stop offset="0%" stop-color="#8b5cf6" stop-opacity=".42" />
                            <stop offset="100%" stop-color="#0ea5e9" stop-opacity="0" />
                        </linearGradient>
                    </defs>
                    <path class="organizer-chart-grid" d="M0 60H600 M0 120H600 M0 180H600 M100 20V230 M220 20V230 M340 20V230 M460 20V230" />
                    <polygon points="{{ $areaPoints }}" fill="url(#overviewChartFill)"></polygon>
                    <polyline points="{{ $chartPoints }}" class="organizer-chart-line"></polyline>
                </svg>
                <div class="organizer-chart-labels">
                    @foreach ($revenueTrend as $point)
                        <span>{{ $point['label'] }}</span>
                    @endforeach
                </div>
            </div>
        </article>

        <article class="organizer-card organizer-reveal">
            <div class="organizer-card__head">
                <div>
                    <h2>Ticket mix</h2>
                    <p>Repartition des ventes par type</p>
                </div>
            </div>

            <div class="organizer-donut" style="--donut: conic-gradient({{ implode(', ', $mixSegments) }});">
                <span></span>
            </div>

            <div class="organizer-mix-list">
                @forelse ($ticketMix as $index => $mix)
                    <div>
                        <span style="--dot-color: {{ $mixColors[$index % count($mixColors)] }}"></span>
                        <strong>{{ $mix['type'] }}</strong>
                        <em>{{ number_format($mix['sold']) }}</em>
                    </div>
                @empty
                    <div>
                        <span style="--dot-color: #94a3b8"></span>
                        <strong>Aucune vente</strong>
                        <em>0</em>
                    </div>
                @endforelse
            </div>
        </article>
    </div>

    <div class="organizer-action-grid">
        <button class="organizer-action-card organizer-reveal" type="button" data-open-create data-searchable>
            <span class="organizer-icon organizer-icon--violet"><x-organizer.icon name="plus" /></span>
            <span>
                <strong>Creer un evenement</strong>
                <small>Lancez une nouvelle page en quelques secondes.</small>
            </span>
            <x-organizer.icon name="arrow" />
        </button>

        <button class="organizer-action-card organizer-reveal" type="button" data-section-target="statistics" data-searchable>
            <span class="organizer-icon organizer-icon--cyan"><x-organizer.icon name="chart" /></span>
            <span>
                <strong>Voir les rapports</strong>
                <small>Analysez les ventes et la conversion.</small>
            </span>
            <x-organizer.icon name="arrow" />
        </button>

        <button class="organizer-action-card organizer-reveal" type="button" data-section-target="participants" data-searchable>
            <span class="organizer-icon organizer-icon--emerald"><x-organizer.icon name="mail" /></span>
            <span>
                <strong>Email participants</strong>
                <small>Preparez une campagne ou un rappel.</small>
            </span>
            <x-organizer.icon name="arrow" />
        </button>
    </div>

    <div class="organizer-dashboard-grid organizer-dashboard-grid--bottom">
        <article class="organizer-card organizer-card--wide organizer-reveal">
            <div class="organizer-card__head">
                <div>
                    <h2>Top evenements</h2>
                    <p>Ventes et occupation des evenements actifs</p>
                </div>
                <button class="organizer-text-button" type="button" data-section-target="events">Tout voir <x-organizer.icon name="arrow" /></button>
            </div>

            <div class="organizer-list">
                @forelse ($eventRows->take(5) as $row)
                    <div class="organizer-list__item" data-searchable>
                        <span class="organizer-list__icon"><x-organizer.icon name="calendar" /></span>
                        <div>
                            <strong>{{ $row['name'] }}</strong>
                            <small>{{ $row['date']->format('d M Y') }} · {{ $row['location'] }}</small>
                        </div>
                        <div class="organizer-progress">
                            <span><i style="width: {{ $row['percentage'] }}%"></i></span>
                            <small>{{ number_format($row['sold']) }} / {{ number_format($row['capacity']) }}</small>
                        </div>
                        <em class="organizer-badge organizer-badge--{{ $row['status']['key'] }}">{{ $row['status']['label'] }}</em>
                    </div>
                @empty
                    <div class="organizer-empty">
                        <strong>Aucun evenement pour le moment</strong>
                        <span>Creer votre premier evenement pour alimenter ce dashboard.</span>
                    </div>
                @endforelse
            </div>
        </article>

        <article class="organizer-card organizer-reveal">
            <div class="organizer-card__head">
                <div>
                    <h2>Inscriptions recentes</h2>
                    <p>Derniers participants enregistres</p>
                </div>
                <x-organizer.icon name="chart" class="organizer-card__accent" />
            </div>

            <div class="organizer-feed">
                @forelse ($recentRegistrations as $registration)
                    <div class="organizer-feed__item" data-searchable>
                        <span>{{ $registration['initials'] }}</span>
                        <div>
                            <strong>{{ $registration['name'] }}</strong>
                            <small>{{ $registration['event'] }} · {{ $registration['tier'] }}</small>
                        </div>
                        <em>{{ $registration['time'] }}</em>
                    </div>
                @empty
                    <div class="organizer-empty">
                        <strong>Aucune inscription</strong>
                        <span>Les nouvelles reservations apparaitront ici.</span>
                    </div>
                @endforelse
            </div>
        </article>
    </div>
</section>
