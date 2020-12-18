<div class="search-area-wrapper">
    <div class="search-area d-flex align-items-center justify-content-center">
        <div class="close-btn">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" id="close-1" width="100%" height="100%">
                <path data-name="layer1" fill="none" stroke="#202020" stroke-miterlimit="10" d="M41.999 20.002l-22 22m22 0L20 20" stroke-linejoin="round" stroke-linecap="round" style="stroke:var(--layer1, #202020)"></path>
            </svg>
        </div>
        <form action="{{route('searchItem')}}" class="search-area-form">
            <div class="form-group position-relative">
                <input type="search" name="search" id="search" placeholder=" {{ __('localization.search')}}" class="search-area-input">
                    <button type="button" id="btn-ss-header" class="search-area-button">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 64 64" id="search-1" width="100%" height="100%">
                            <path data-name="layer2" fill="none" stroke="#202020" stroke-miterlimit="10" d="M39.049 39.049L56 56" stroke-linejoin="round" stroke-linecap="round" style="stroke:var(--layer1, #202020)"></path>
                            <circle data-name="layer1" cx="27" cy="27" r="17" fill="none" stroke="#202020" stroke-miterlimit="10" stroke-linejoin="round" stroke-linecap="round" style="stroke:var(--layer1, #202020)"></circle>
                        </svg>
                    </button>
            </div>
        </form>
    </div>
</div>	