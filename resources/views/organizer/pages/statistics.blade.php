@php
    $statsTrendValues = $revenueTrend->pluck('value');
    $statsMaxTrend = max(1, $statsTrendValues->max() ?: 1);
    $statsTrendCount = max(1, $revenueTrend->count() - 1);
    $statsChartPoints = $revenueTrend->values()->map(function ($point, $index) use ($statsMaxTrend, $statsTrendCount) {
        $x = round(($index / $statsTrendCount) * 600, 1);
        $y = round(220 - (($point['value'] / $statsMaxTrend) * 170), 1);

        return $x.','.$y;
    })->implode(' ');
    $statsAreaPoints = '0,240 '.$statsChartPoints.' 600,240';
    $funnelViews = max(100, ($stats['tickets_sold'] + $stats['available_tickets']) * 3);
    $funnelClicks = max(0, $stats['tickets_sold'] + $stats['reservations']);
    $funnelCheckout = max(0, $stats['reservations']);
    $funnelCompleted = max(0, $stats['tickets_sold']);
@endphp

<section class="organizer-panel" data-section-panel="statistics" hidden>
    <div class="organizer-stats-grid">
        <x-organizer.stat-card icon="eye" label="Vues estimees" :value="number_format($funnelViews)" :trend="'+' . $stats['conversion'] . '%'" tone="violet" />
        <x-organizer.stat-card icon="chart" label="Conversion" :value="$stats['conversion'].'%'" trend="+1.2pp" tone="cyan" />
        <x-organizer.stat-card icon="card" label="Panier moyen" :value="number_format($stats['average_order'], 0, ',', ' ').' FCFA'" trend="+6%" tone="emerald" />
        <x-organizer.stat-card icon="wallet" label="MRR evenementiel" :value="number_format($stats['revenue'], 0, ',', ' ').' FCFA'" trend="+22%" tone="pink" />
    </div>

    <div class="organizer-dashboard-grid">
        <article class="organizer-card organizer-card--wide organizer-reveal">
            <div class="organizer-card__head">
                <div>
                    <h2>Tendance revenus</h2>
                    <p>Performance mensuelle consolidee</p>
                </div>
            </div>

            <div class="organizer-line-chart organizer-line-chart--large">
                <svg viewBox="0 0 600 240" preserveAspectRatio="none" role="img" aria-label="Tendance des revenus">
                    <defs>
                        <linearGradient id="statsChartFill" x1="0" x2="0" y1="0" y2="1">
                            <stop offset="0%" stop-color="#0ea5e9" stop-opacity=".45" />
                            <stop offset="100%" stop-color="#8b5cf6" stop-opacity="0" />
                        </linearGradient>
                    </defs>
                    <path class="organizer-chart-grid" d="M0 60H600 M0 120H600 M0 180H600 M100 20V230 M220 20V230 M340 20V230 M460 20V230" />
                    <polygon points="{{ $statsAreaPoints }}" fill="url(#statsChartFill)"></polygon>
                    <polyline points="{{ $statsChartPoints }}" class="organizer-chart-line organizer-chart-line--cyan"></polyline>
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
                    <h2>Funnel conversion</h2>
                    <p>Vue simplifiee du parcours d'achat</p>
                </div>
            </div>

            <div class="organizer-funnel">
                <div>
                    <span><x-organizer.icon name="eye" /> Vues</span>
                    <strong>{{ number_format($funnelViews) }}</strong>
                    <i style="width: 100%"></i>
                </div>
                <div>
                    <span><x-organizer.icon name="ticket" /> Clic reservation</span>
                    <strong>{{ number_format($funnelClicks) }}</strong>
                    <i style="width: {{ min(100, round(($funnelClicks / $funnelViews) * 100)) }}%"></i>
                </div>
                <div>
                    <span><x-organizer.icon name="card" /> Checkout</span>
                    <strong>{{ number_format($funnelCheckout) }}</strong>
                    <i style="width: {{ min(100, round(($funnelCheckout / $funnelViews) * 100)) }}%"></i>
                </div>
                <div>
                    <span><x-organizer.icon name="wallet" /> Complete</span>
                    <strong>{{ number_format($funnelCompleted) }}</strong>
                    <i style="width: {{ min(100, round(($funnelCompleted / $funnelViews) * 100)) }}%"></i>
                </div>
            </div>
        </article>
    </div>
</section>
