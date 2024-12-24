<div class="jackpot-text text-center py-4">
    <h2 class="text-2xl font-bold text-white">
        @if(isset($settings) && $settings?->jackpot_text)
            {{ $settings?->jackpot_text }}
        @else
            BUKTI JACKPOT LUNAS
        @endif
    </h2>
</div>