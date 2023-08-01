<div class="voice-item">
    <h5 style="text-align: left;margin-left: 30px;">
        {{ $sample->title }}
    </h5>
    <div class="audio green-audio-player" style="z-index: 0">
        <div class="play-music flex-box play-pause-btn" data-id="{{ $sample->id }}">
            <svg xmlns="http://www.w3.org/2000/svg" width="15" height="18" viewBox="0 0 18 24" style="margin-left: 0 !important;">
                <path fill="#fff" fill-rule="evenodd" d="M18 12L0 24V0" class="play-pause-icon" id="playPause"></path>
            </svg>
        </div>

        <div class="controls">
            <span class="current-time" id="current_time{{ $sample->id }}">0:00</span>
            <div class="slider" data-direction="horizontal">
                <div class="progress" id="progress{{ $sample->id }}">
                    <div class="pin" id="progress-pin"
                         data-method="rewind"></div>
                </div>
            </div>
            <span class="total-time">0:00</span>
        </div>

        <audio id="sample{{$sample->id}}" crossorigin>
            <source src="{{ $sample->link }}" type="audio/mpeg">
        </audio>
    </div>
    <div class="line"></div>
</div>
