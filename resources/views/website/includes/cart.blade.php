<div class="float-cart">
    <a href="{{ route('home.product.cart') }}" target="_blank" class="float" id="menu-share">
        <span class="count-num" data-count="{{$productCount}}">
            <i class="fa fa-cart-shopping my-float"></i>
        </span>
    </a>
</div>


<style>
    .count-num[data-count]:after{
        position:absolute;
        right:0%;
        top:0%;
        content: attr(data-count);
        font-size:65%;
        padding:.6em;
        border-radius:999px;
        line-height:.75em;
        color: #F33 !important;
        text-align:center;
        min-width:2em;
        font-weight:bold;
        background: white;
    }

    .float-cart{
        display: none !important;
    }

    @media screen and (min-width: 100px) and (max-width: 992px){
        .float-cart{
            display: block !important;
        }
    }


    .float{
        position:fixed;
        width:60px;
        height:60px;
        bottom:100px;
        right:30px;
        background-color: #F33;
        color: #FFFFFF !important;
        border-radius:50px;
        text-align:center;
        /*box-shadow: 2px 2px 3px #999;*/
        z-index:1000;
        animation: bot-to-top 2s ease-out;
    }

    .my-float{
        font-size:24px;
        margin-top:18px;
    }

    a#menu-share span i{
        animation: rotate-in 0.5s;
    }

    a#menu-share:hover span > i{
        animation: rotate-out 0.5s;
    }

    @keyframes bot-to-top {
        0%   {bottom:-40px}
        50%  {bottom:100px}
    }

    @keyframes scale-in {
        from {transform: scale(0);opacity: 0;}
        to {transform: scale(1);opacity: 1;}
    }

</style>
