@extends('.client.layouts.main')
@section('content')
    <div class="prd1-cont container-fluid">
        <div class="row">

            <!-- FILTER ON PC VERSION (will be hidden on mobile)-->
            <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 prd1-left hidden-xs hidden-sm">
                <div class="row left-type">
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                        <li role="presentation" data-id="men,women" class=""><a href="#all" aria-controls="home"
                                role="tab" data-toggle="tab">TẤT CẢ</a></li>
                        <li role="presentation" class="type-divider"></li>
                        <li role="presentation" data-id="men" class=""><a href="#men" aria-controls="profile"
                                role="tab" data-toggle="tab">NAM</a></li>
                        <li role="presentation" class="type-divider"></li>
                        <li data-id="women" role="presentation" class=""><a href="#women" aria-controls="profile"
                                role="tab" data-toggle="tab">NỮ</a></li>

                    </ul>
                </div>
                <div class="row left-divider"></div>
                <div class="row left-type-item">
                    <!-- Tab panes -->
                    <div class="tab-content">
                        <div role="tabpanel" class="tab-pane" id="men">
                            <ul class="nav nav-pills nav-stacked">
                                <li class="" data-id="accessories">
                                    <a>Accessories | Phụ kiện <span class="glyphicon"></span></a>
                                </li>
                                <li class="" data-id="football-apparel">
                                    <a>Football Apparel <span class="glyphicon"></span></a>
                                </li>
                                <li class="" data-id="football-equipment">
                                    <a>Football Equipment <span class="glyphicon"></span></a>
                                </li>
                                <li class="" data-id="shoes">
                                    <a>Footwear | Lên chân <span class="glyphicon"></span></a>
                                </li>
                                <li class="" data-id="skateboard">
                                    <a>Skateboard <span class="glyphicon"></span></a>
                                </li>
                                <li class="" data-id="top">
                                    <a>Top | Nửa trên <span class="glyphicon"></span></a>
                                </li>
                            </ul>
                        </div>
                        <div role="tabpanel" class="tab-pane" id="women">
                            <ul class="nav nav-pills nav-stacked">
                                <li class="" data-id="accessories">
                                    <a>Accessories | Phụ kiện <span class="glyphicon"></span></a>
                                </li>
                                <li class="" data-id="football-apparel">
                                    <a>Football Apparel <span class="glyphicon"></span></a>
                                </li>
                                <li class="" data-id="football-equipment">
                                    <a>Football Equipment <span class="glyphicon"></span></a>
                                </li>
                                <li class="" data-id="shoes">
                                    <a>Footwear | Lên chân <span class="glyphicon"></span></a>
                                </li>
                                <li class="" data-id="skateboard">
                                    <a>Skateboard <span class="glyphicon"></span></a>
                                </li>
                                <li class="" data-id="top">
                                    <a>Top | Nửa trên <span class="glyphicon"></span></a>
                                </li>
                            </ul>
                        </div>
                        <div role="tabpanel" class="tab-pane active" id="all">
                            <ul class="nav nav-pills nav-stacked">
                                <li class="" data-id="accessories">
                                    <a>Accessories | Phụ kiện <span class="glyphicon"></span></a>
                                </li>
                                <li class="" data-id="football-apparel">
                                    <a>Football Apparel <span class="glyphicon"></span></a>
                                </li>
                                <li class="" data-id="football-equipment">
                                    <a>Football Equipment <span class="glyphicon"></span></a>
                                </li>
                                <li class="" data-id="shoes">
                                    <a>Footwear | Lên chân <span class="glyphicon"></span></a>
                                </li>
                                <li class="" data-id="skateboard">
                                    <a>Skateboard <span class="glyphicon"></span></a>
                                </li>
                                <li class="" data-id="top">
                                    <a>Top | Nửa trên <span class="glyphicon"></span></a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="row left-divider"></div>

                <div class="row left-tree">
                    <ul class="nav">
                        <li class="first-lvl">
                            <label label-default="" class="tree-toggle nav-header orange">TRẠNG THÁI <span
                                    class="caret caret-active"></span></label>
                            <ul class="nav tree">
                                <li>
                                    <label>
                                        <input name="cbStatus" class="cb-item" type="checkbox" value="limited-edition"
                                            hidden>Limited Edition <span class="glyphicon"></span>
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input name="cbStatus" class="cb-item" type="checkbox" value="online-only"
                                            hidden>Online Only <span class="glyphicon"></span>
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input name="cbStatus" class="cb-item" type="checkbox" value="sale-off"
                                            hidden>Sale off <span class="glyphicon"></span>
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input name="cbStatus" class="cb-item" type="checkbox" value="new-arrival"
                                            hidden>New Arrival <span class="glyphicon"></span>
                                    </label>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-divider"></li>
                        <li class="first-lvl">
                            <label label-default="" class="tree-toggle nav-header orange">KIỂU DÁNG <span
                                    class="caret caret-active"></span></label>
                            <ul class="nav tree">
                                <li>
                                    <label>
                                        <input name="cbStatus" class="cb-item" type="checkbox" value="low-top"
                                            hidden>Low Top <span class="glyphicon"></span>
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input name="cbStatus" class="cb-item" type="checkbox" value="high-top"
                                            hidden>High Top <span class="glyphicon"></span>
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input name="cbStatus" class="cb-item" type="checkbox" value="slip-on"
                                            hidden>Slip-on <span class="glyphicon"></span>
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input name="cbStatus" class="cb-item" type="checkbox" value="mid-top"
                                            hidden>Mid Top <span class="glyphicon"></span>
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input name="cbStatus" class="cb-item" type="checkbox" value="mule"
                                            hidden>Mule <span class="glyphicon"></span>
                                    </label>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-divider"></li>
                        <li class="first-lvl">
                            <label label-default="" class="tree-toggle nav-header orange">DÒNG SẢN PHẨM <span
                                    class="caret caret-active"></span></label>
                            <ul class="nav tree">
                                <li>
                                    <label>
                                        <input name="cbStatus" class="cb-item" type="checkbox" value="basas"
                                            hidden>Basas <span class="glyphicon"></span>
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input name="cbStatus" class="cb-item" type="checkbox" value="vintas"
                                            hidden>Vintas <span class="glyphicon"></span>
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input name="cbStatus" class="cb-item" type="checkbox" value="urbas"
                                            hidden>Urbas <span class="glyphicon"></span>
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input name="cbStatus" class="cb-item" type="checkbox" value="pattas"
                                            hidden>Pattas <span class="glyphicon"></span>
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input name="cbStatus" class="cb-item" type="checkbox" value="tote-bag"
                                            hidden>Tote Bag <span class="glyphicon"></span>
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input name="cbStatus" class="cb-item" type="checkbox" value="graphic-tee"
                                            hidden>Graphic Tee <span class="glyphicon"></span>
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input name="cbStatus" class="cb-item" type="checkbox" value="hoodie"
                                            hidden>Hoodie <span class="glyphicon"></span>
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input name="cbStatus" class="cb-item" type="checkbox" value="socks"
                                            hidden>Socks | Vớ <span class="glyphicon"></span>
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input name="cbStatus" class="cb-item" type="checkbox"
                                            value="merchandise-sweatshirt" hidden>Merchandise Sweatshirt <span
                                            class="glyphicon"></span>
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input name="cbStatus" class="cb-item" type="checkbox" value="merchandise-tee"
                                            hidden>Merchandise Tee <span class="glyphicon"></span>
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input name="cbStatus" class="cb-item" type="checkbox" value="grip-tape"
                                            hidden>Grip Tape <span class="glyphicon"></span>
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input name="cbStatus" class="cb-item" type="checkbox" value="deck"
                                            hidden>Deck <span class="glyphicon"></span>
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input name="cbStatus" class="cb-item" type="checkbox" value="complete"
                                            hidden>Complete <span class="glyphicon"></span>
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input name="cbStatus" class="cb-item" type="checkbox" value="t-tool"
                                            hidden>T-Tool <span class="glyphicon"></span>
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input name="cbStatus" class="cb-item" type="checkbox"
                                            value="retro-football-jersey" hidden>Retro Football Jersey <span
                                            class="glyphicon"></span>
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input name="cbStatus" class="cb-item" type="checkbox" value="die-cut-insoles"
                                            hidden>Die-cut Insoles <span class="glyphicon"></span>
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input name="cbStatus" class="cb-item" type="checkbox" value="souvenir-ball"
                                            hidden>Souvenir Ball <span class="glyphicon"></span>
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input name="cbStatus" class="cb-item" type="checkbox" value="effect-tee"
                                            hidden>Effect Tee <span class="glyphicon"></span>
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input name="cbStatus" class="cb-item" type="checkbox" value="hip-pack"
                                            hidden>Hip Pack <span class="glyphicon"></span>
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input name="cbStatus" class="cb-item" type="checkbox" value="track-6"
                                            hidden>Track 6 <span class="glyphicon"></span>
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input name="cbStatus" class="cb-item" type="checkbox" value="basic-tee"
                                            hidden>Basic Tee <span class="glyphicon"></span>
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input name="cbStatus" class="cb-item" type="checkbox" value="shoelaces"
                                            hidden>Shoelaces <span class="glyphicon"></span>
                                    </label>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-divider"></li>
                        <li class="first-lvl">
                            <label label-default="" class="tree-toggle nav-header orange">GIÁ <span
                                    class="caret caret-active"></span></label>
                            <ul class="nav tree">
                                <li>
                                    <label>
                                        <input name="cbStatus" class="cb-item" type="checkbox" value="500-599k"
                                            hidden>500k - 599k <span class="glyphicon"></span>
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input name="cbStatus" class="cb-item" type="checkbox" value="600k"
                                            hidden>&gt; 600k <span class="glyphicon"></span>
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input name="cbStatus" class="cb-item" type="checkbox" value="400-499k"
                                            hidden>400k - 499k <span class="glyphicon"></span>
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input name="cbStatus" class="cb-item" type="checkbox" value="300-399k"
                                            hidden>300k - 399k <span class="glyphicon"></span>
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input name="cbStatus" class="cb-item" type="checkbox" value="200-299k"
                                            hidden>200k - 299k <span class="glyphicon"></span>
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input name="cbStatus" class="cb-item" type="checkbox" value="200k-range-price"
                                            hidden>&lt; 200k <span class="glyphicon"></span>
                                    </label>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-divider"></li>
                        <li class="first-lvl">
                            <label label-default="" class="tree-toggle nav-header orange">BỘ SƯU TẬP <span
                                    class="caret caret-active"></span></label>
                            <ul class="nav tree">
                                <li>
                                    <label>
                                        <input name="cbStatus" class="cb-item" type="checkbox" value="axgc-logo"
                                            hidden>AXGC Logo <span class="glyphicon"></span>
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input name="cbStatus" class="cb-item" type="checkbox" value="recycled-material"
                                            hidden>Recycled Material <span class="glyphicon"></span>
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input name="cbStatus" class="cb-item" type="checkbox" value="denim"
                                            hidden>Denim <span class="glyphicon"></span>
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input name="cbStatus" class="cb-item" type="checkbox" value="the-team"
                                            hidden>The Team <span class="glyphicon"></span>
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input name="cbStatus" class="cb-item" type="checkbox" value="day-slide"
                                            hidden>Day Slide <span class="glyphicon"></span>
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input name="cbStatus" class="cb-item" type="checkbox" value="randomly"
                                            hidden>Randomly <span class="glyphicon"></span>
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input name="cbStatus" class="cb-item" type="checkbox" value="public-2000s"
                                            hidden>Public 2000s <span class="glyphicon"></span>
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input name="cbStatus" class="cb-item" type="checkbox"
                                            value="ananas-global-goal" hidden>Ananas Global Goal <span
                                            class="glyphicon"></span>
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input name="cbStatus" class="cb-item" type="checkbox" value="vivu"
                                            hidden>Vivu <span class="glyphicon"></span>
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input name="cbStatus" class="cb-item" type="checkbox"
                                            value="ananas-daily-things" hidden>Ananas Daily Things <span
                                            class="glyphicon"></span>
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input name="cbStatus" class="cb-item" type="checkbox" value="nauda"
                                            hidden>Nauda <span class="glyphicon"></span>
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input name="cbStatus" class="cb-item" type="checkbox"
                                            value="ananas-music-fest-2023" hidden>Ananas Music Fest 2023 <span
                                            class="glyphicon"></span>
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input name="cbStatus" class="cb-item" type="checkbox" value="tom"
                                            hidden>Tomo <span class="glyphicon"></span>
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input name="cbStatus" class="cb-item" type="checkbox"
                                            value="ananas-puppet-club" hidden>Ananas Puppet Club <span
                                            class="glyphicon"></span>
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input name="cbStatus" class="cb-item" type="checkbox" value="2-blues"
                                            hidden>2.Blues <span class="glyphicon"></span>
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input name="cbStatus" class="cb-item" type="checkbox"
                                            value="ananas-outline-typo" hidden>Ananas Outline Typo <span
                                            class="glyphicon"></span>
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input name="cbStatus" class="cb-item" type="checkbox" value="jazico"
                                            hidden>Jazico <span class="glyphicon"></span>
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input name="cbStatus" class="cb-item" type="checkbox" value="track-6-isee"
                                            hidden>I.S.E.E <span class="glyphicon"></span>
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input name="cbStatus" class="cb-item" type="checkbox" value="soda-pop"
                                            hidden>Soda Pop <span class="glyphicon"></span>
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input name="cbStatus" class="cb-item" type="checkbox" value="landforms"
                                            hidden>Landforms <span class="glyphicon"></span>
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input name="cbStatus" class="cb-item" type="checkbox" value="solid-colors"
                                            hidden>SC <span class="glyphicon"></span>
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input name="cbStatus" class="cb-item" type="checkbox"
                                            value="ananas-copy-store-bag" hidden>Ananas "Copy" Store Bag <span
                                            class="glyphicon"></span>
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input name="cbStatus" class="cb-item" type="checkbox" value="workaday"
                                            hidden>Workaday <span class="glyphicon"></span>
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input name="cbStatus" class="cb-item" type="checkbox" value="evergreen-pack"
                                            hidden>Evergreen <span class="glyphicon"></span>
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input name="cbStatus" class="cb-item" type="checkbox" value="raw" hidden>RAW
                                        <span class="glyphicon"></span>
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input name="cbStatus" class="cb-item" type="checkbox" value="polka-dots"
                                            hidden>Polka Dots <span class="glyphicon"></span>
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input name="cbStatus" class="cb-item" type="checkbox" value="retrospective"
                                            hidden>Retrospective <span class="glyphicon"></span>
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input name="cbStatus" class="cb-item" type="checkbox" value="aunter"
                                            hidden>Aunter <span class="glyphicon"></span>
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input name="cbStatus" class="cb-item" type="checkbox" value="ruler"
                                            hidden>Ruler <span class="glyphicon"></span>
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input name="cbStatus" class="cb-item" type="checkbox" value="flannel-pack"
                                            hidden>Flannel <span class="glyphicon"></span>
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input name="cbStatus" class="cb-item" type="checkbox" value="class-e"
                                            hidden>Class E <span class="glyphicon"></span>
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input name="cbStatus" class="cb-item" type="checkbox" value="loveplus"
                                            hidden>Love+ <span class="glyphicon"></span>
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input name="cbStatus" class="cb-item" type="checkbox"
                                            value="ananas-doraemon-50years" hidden>Ananas x Doraemon 50 Years <span
                                            class="glyphicon"></span>
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input name="cbStatus" class="cb-item" type="checkbox" value="discoveryou"
                                            hidden>DiscoverYou <span class="glyphicon"></span>
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input name="cbStatus" class="cb-item" type="checkbox" value="ananas-typo-logo"
                                            hidden>Ananas Typo Logo <span class="glyphicon"></span>
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input name="cbStatus" class="cb-item" type="checkbox" value="og" hidden>OG
                                        <span class="glyphicon"></span>
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input name="cbStatus" class="cb-item" type="checkbox" value="all-suede"
                                            hidden>All Suede <span class="glyphicon"></span>
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input name="cbStatus" class="cb-item" type="checkbox" value="corluray"
                                            hidden>Corluray <span class="glyphicon"></span>
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input name="cbStatus" class="cb-item" type="checkbox" value="simple-life"
                                            hidden>Simple Life <span class="glyphicon"></span>
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input name="cbStatus" class="cb-item" type="checkbox" value="mono-black"
                                            hidden>Mono Black <span class="glyphicon"></span>
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input name="cbStatus" class="cb-item" type="checkbox" value="hook-n-loop"
                                            hidden>Hook n' Loop <span class="glyphicon"></span>
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input name="cbStatus" class="cb-item" type="checkbox" value="bumper-gum"
                                            hidden>Bumper Gum <span class="glyphicon"></span>
                                    </label>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-divider"></li>
                        <li class="first-lvl">
                            <label label-default="" class="tree-toggle nav-header orange">CHẤT LIỆU <span
                                    class="caret caret-active"></span></label>
                            <ul class="nav tree">
                                <li>
                                    <label>
                                        <input name="cbStatus" class="cb-item" type="checkbox" value="canvas"
                                            hidden>Canvas <span class="glyphicon"></span>
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input name="cbStatus" class="cb-item" type="checkbox" value="suede"
                                            hidden>Suede | Da lộn <span class="glyphicon"></span>
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input name="cbStatus" class="cb-item" type="checkbox" value="pu"
                                            hidden>Synthetic Leather <span class="glyphicon"></span>
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input name="cbStatus" class="cb-item" type="checkbox" value="leather"
                                            hidden>Leather | Da <span class="glyphicon"></span>
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input name="cbStatus" class="cb-item" type="checkbox" value="cotton"
                                            hidden>Cotton <span class="glyphicon"></span>
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input name="cbStatus" class="cb-item" type="checkbox" value="pp" hidden>PP
                                        <span class="glyphicon"></span>
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input name="cbStatus" class="cb-item" type="checkbox" value="steel"
                                            hidden>Steel <span class="glyphicon"></span>
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input name="cbStatus" class="cb-item" type="checkbox" value="paper"
                                            hidden>Paper <span class="glyphicon"></span>
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input name="cbStatus" class="cb-item" type="checkbox" value="aluminium"
                                            hidden>Aluminium <span class="glyphicon"></span>
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input name="cbStatus" class="cb-item" type="checkbox" value="canadian-maple"
                                            hidden>Canadian Maple <span class="glyphicon"></span>
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input name="cbStatus" class="cb-item" type="checkbox"
                                            value="ortholite-recycled-foam" hidden>Ortholite Recycled Foam <span
                                            class="glyphicon"></span>
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input name="cbStatus" class="cb-item" type="checkbox" value="denim-material"
                                            hidden>Denim <span class="glyphicon"></span>
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input name="cbStatus" class="cb-item" type="checkbox" value="taslan"
                                            hidden>Taslan <span class="glyphicon"></span>
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input name="cbStatus" class="cb-item" type="checkbox" value="knit"
                                            hidden>Knit <span class="glyphicon"></span>
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input name="cbStatus" class="cb-item" type="checkbox" value="ripstop"
                                            hidden>Ripstop <span class="glyphicon"></span>
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input name="cbStatus" class="cb-item" type="checkbox" value="single-jersey"
                                            hidden>Single Jersey <span class="glyphicon"></span>
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input name="cbStatus" class="cb-item" type="checkbox" value="terry"
                                            hidden>Terry <span class="glyphicon"></span>
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input name="cbStatus" class="cb-item" type="checkbox" value="flannel"
                                            hidden>Flannel <span class="glyphicon"></span>
                                    </label>
                                </li>
                                <li>
                                    <label>
                                        <input name="cbStatus" class="cb-item" type="checkbox" value="corduroy"
                                            hidden>Corduroy <span class="glyphicon"></span>
                                    </label>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-divider"></li>
                        <li class="first-lvl">
                            <label label-default="" class="tree-toggle nav-header orange">MÀU SẮC <span
                                    class="caret caret-active"></span></label>
                            <ul class="nav tree">
                                <li class="cb-color">
                                    <label><span class="bg-color" style="background-color: #Materialcolor;"></span>
                                        <input name="cbColor" type="checkbox" value="material-color" hidden></label>
                                    <label><span class="bg-color" style="background-color: #Transparentcolor;"></span>
                                        <input name="cbColor" type="checkbox" value="transparent-color" hidden></label>
                                    <label><span class="bg-color" style="background-color: #a49c8e;"></span>
                                        <input name="cbColor" type="checkbox" value="goat" hidden></label>
                                    <label><span class="bg-color" style="background-color: #Multicolor;"></span>
                                        <input name="cbColor" type="checkbox" value="multi-color" hidden></label>
                                    <label><span class="bg-color" style="background-color: #fefbef;"></span>
                                        <input name="cbColor" type="checkbox" value="offwhite" hidden></label>
                                    <label><span class="bg-color" style="background-color: #455851;"></span>
                                        <input name="cbColor" type="checkbox" value="pineneedle" hidden></label>
                                    <label><span class="bg-color" style="background-color: #006964;"></span>
                                        <input name="cbColor" type="checkbox" value="teal-color" hidden></label>
                                    <label><span class="bg-color" style="background-color: #ebd0a2;"></span>
                                        <input name="cbColor" type="checkbox" value="beige" hidden></label>
                                    <label><span class="bg-color" style="background-color: #c3c3c3;"></span>
                                        <input name="cbColor" type="checkbox" value="grey" hidden></label>
                                    <label><span class="bg-color" style="background-color: #1c487c;"></span>
                                        <input name="cbColor" type="checkbox" value="navy" hidden></label>
                                    <label><span class="bg-color" style="background-color: #865439;"></span>
                                        <input name="cbColor" type="checkbox" value="brown" hidden></label>
                                    <label><span class="bg-color" style="background-color: #ffffff;"></span>
                                        <input name="cbColor" type="checkbox" value="white" hidden></label>
                                    <label><span class="bg-color" style="background-color: #6d9951;"></span>
                                        <input name="cbColor" type="checkbox" value="green" hidden></label>
                                    <label><span class="bg-color" style="background-color: #8a5ca0;"></span>
                                        <input name="cbColor" type="checkbox" value="violet" hidden></label>
                                    <label><span class="bg-color" style="background-color: #f1778a;"></span>
                                        <input name="cbColor" type="checkbox" value="pink" hidden></label>
                                    <label><span class="bg-color" style="background-color: #f5d255;"></span>
                                        <input name="cbColor" type="checkbox" value="yellow" hidden></label>
                                    <label><span class="bg-color" style="background-color: #e9662c;"></span>
                                        <input name="cbColor" type="checkbox" value="orange" hidden></label>
                                    <label><span class="bg-color" style="background-color: #c10013;"></span>
                                        <input name="cbColor" type="checkbox" value="red" hidden></label>
                                    <label><span class="bg-color" style="background-color: #464646;"></span>
                                        <input name="cbColor" type="checkbox" value="black" hidden></label>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-divider"></li>
                    </ul>
                </div>
            </div>
            <!-- END FILTER ON PC VERSION (will be hidden on mobile)-->

            <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9 prd1-right">
                <!-- PC -->
                <div class="row prd1-right-box hidden-xs hidden-sm">
                    {{-- <img src="{{ asset('assetsClients/wp-content/uploads/hinh-anh-gai-xinh-tiktok-dep-01.jpg') }}"> --}}
                </div>
                <!-- End PC -->

                <!-- Mobile -->
                <div class="row prd1-right-box-mobile visible-xs visible-sm">
                    {{-- <img src="{{ asset('assetsClients/wp-content/uploads/hinh-anh-gai-xinh-tiktok-dep-01.jpg') }}"> --}}
                </div>
                <!-- End Mobile -->

                <!-- FILTER ON MOBILE VERSION -->
                <div class="row filter-mobile visible-xs visible-sm">
                    <div class="title-main">
                        <ul class="nav nav-tabs nav-justified" role="tablist">
                            <li role="presentation" data-id="men,women" class="active"><a href="#mb_all" role="tab"
                                    data-toggle="tab">TẤT CẢ</a></li>
                            <div class="divider"></div>
                            <li role="presentation" data-id="men" class=""><a href="#mb_men" role="tab"
                                    data-toggle="tab">NAM</a></li>
                            <div class="divider"></div>
                            <li role="presentation" data-id="women" class=""><a href="#mb_women" role="tab"
                                    data-toggle="tab">NỮ</a></li>
                        </ul>
                    </div>

                    <div class="tab">
                        <!-- Nav tabs -->
                        <ul class="nav nav-tabs mb-category">
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane " id="mb_men">
                                    <li class="" data-id="accessories"><a href="#accessories">Accessories | Phụ
                                            kiện</a></li>
                                    <div class="divider"></div>
                                    <li class="" data-id="football-apparel"><a href="#football-apparel">Football
                                            Apparel</a></li>
                                    <div class="divider"></div>
                                    <li class="" data-id="football-equipment"><a
                                            href="#football-equipment">Football Equipment</a></li>
                                    <div class="divider"></div>
                                    <li class="" data-id="shoes"><a href="#shoes">Footwear | Lên chân</a></li>
                                    <div class="divider"></div>
                                    <li class="" data-id="skateboard"><a href="#skateboard">Skateboard</a></li>
                                    <div class="divider"></div>
                                    <li class="" data-id="top"><a href="#top">Top | Nửa trên</a></li>
                                </div>
                                <div role="tabpanel" class="tab-pane " id="mb_women">
                                    <li class="" data-id="accessories"><a href="#accessories">Accessories | Phụ
                                            kiện</a></li>
                                    <div class="divider"></div>
                                    <li class="" data-id="football-apparel"><a href="#football-apparel">Football
                                            Apparel</a></li>
                                    <div class="divider"></div>
                                    <li class="" data-id="football-equipment"><a
                                            href="#football-equipment">Football Equipment</a></li>
                                    <div class="divider"></div>
                                    <li class="" data-id="shoes"><a href="#shoes">Footwear | Lên chân</a></li>
                                    <div class="divider"></div>
                                    <li class="" data-id="skateboard"><a href="#skateboard">Skateboard</a></li>
                                    <div class="divider"></div>
                                    <li class="" data-id="top"><a href="#top">Top | Nửa trên</a></li>
                                </div>
                                <div role="tabpanel" class="tab-pane active" id="mb_all">
                                    <li class="" data-id="accessories"><a href="#accessories">Accessories | Phụ
                                            kiện</a></li>
                                    <div class="divider"></div>
                                    <li class="" data-id="football-apparel"><a href="#football-apparel">Football
                                            Apparel</a></li>
                                    <div class="divider"></div>
                                    <li class="" data-id="football-equipment"><a
                                            href="#football-equipment">Football Equipment</a></li>
                                    <div class="divider"></div>
                                    <li class="" data-id="shoes"><a href="#shoes">Footwear | Lên chân</a></li>
                                    <div class="divider"></div>
                                    <li class="" data-id="skateboard"><a href="#skateboard">Skateboard</a></li>
                                    <div class="divider"></div>
                                    <li class="" data-id="top"><a href="#top">Top | Nửa trên</a></li>
                                </div>
                            </div>
                        </ul>
                        <!-- Tab panes -->
                        <div class="tab-content tabs">

                            <!-- Content Section1 -->
                            <div class="tab-pane fade in active">
                                <div class="col-xs-6 col-sm-6 option collapsed" data-target="#option1"
                                    data-toggle="collapse">
                                    TÙY CHỌN <span class="caret"></span>
                                </div>
                                <div class="col-xs-6 col-sm-6 txt-countproduct">207 Sản phẩm</div>
                                <div class="col-xs-12 col-sm-12">
                                    <div id="option1" class="collapse left-tree-mobile">
                                        <ul class="nav">
                                            <li class="first-lvl">
                                                <label label-default="" class="tree-toggle nav-header orange">TRẠNG
                                                    THÁI<span class="caret caret-active"></span></label>
                                                <ul class="nav tree">
                                                    <li>
                                                        <label>
                                                            <input name="cbStatus" class="cb-item" type="checkbox"
                                                                value="limited-edition" hidden>Limited Edition <span
                                                                class="glyphicon"></span>
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label>
                                                            <input name="cbStatus" class="cb-item" type="checkbox"
                                                                value="online-only" hidden>Online Only <span
                                                                class="glyphicon"></span>
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label>
                                                            <input name="cbStatus" class="cb-item" type="checkbox"
                                                                value="sale-off" hidden>Sale off <span
                                                                class="glyphicon"></span>
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label>
                                                            <input name="cbStatus" class="cb-item" type="checkbox"
                                                                value="new-arrival" hidden>New Arrival <span
                                                                class="glyphicon"></span>
                                                        </label>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="nav-divider"></li>
                                            <li class="first-lvl">
                                                <label label-default="" class="tree-toggle nav-header orange">KIỂU
                                                    DÁNG<span class="caret caret-active"></span></label>
                                                <ul class="nav tree">
                                                    <li>
                                                        <label>
                                                            <input name="cbStatus" class="cb-item" type="checkbox"
                                                                value="low-top" hidden>Low Top <span
                                                                class="glyphicon"></span>
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label>
                                                            <input name="cbStatus" class="cb-item" type="checkbox"
                                                                value="high-top" hidden>High Top <span
                                                                class="glyphicon"></span>
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label>
                                                            <input name="cbStatus" class="cb-item" type="checkbox"
                                                                value="slip-on" hidden>Slip-on <span
                                                                class="glyphicon"></span>
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label>
                                                            <input name="cbStatus" class="cb-item" type="checkbox"
                                                                value="mid-top" hidden>Mid Top <span
                                                                class="glyphicon"></span>
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label>
                                                            <input name="cbStatus" class="cb-item" type="checkbox"
                                                                value="mule" hidden>Mule <span class="glyphicon"></span>
                                                        </label>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="nav-divider"></li>
                                            <li class="first-lvl">
                                                <label label-default="" class="tree-toggle nav-header orange">DÒNG SẢN
                                                    PHẨM<span class="caret caret-active"></span></label>
                                                <ul class="nav tree">
                                                    <li>
                                                        <label>
                                                            <input name="cbStatus" class="cb-item" type="checkbox"
                                                                value="basas" hidden>Basas <span
                                                                class="glyphicon"></span>
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label>
                                                            <input name="cbStatus" class="cb-item" type="checkbox"
                                                                value="vintas" hidden>Vintas <span
                                                                class="glyphicon"></span>
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label>
                                                            <input name="cbStatus" class="cb-item" type="checkbox"
                                                                value="urbas" hidden>Urbas <span
                                                                class="glyphicon"></span>
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label>
                                                            <input name="cbStatus" class="cb-item" type="checkbox"
                                                                value="pattas" hidden>Pattas <span
                                                                class="glyphicon"></span>
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label>
                                                            <input name="cbStatus" class="cb-item" type="checkbox"
                                                                value="tote-bag" hidden>Tote Bag <span
                                                                class="glyphicon"></span>
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label>
                                                            <input name="cbStatus" class="cb-item" type="checkbox"
                                                                value="graphic-tee" hidden>Graphic Tee <span
                                                                class="glyphicon"></span>
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label>
                                                            <input name="cbStatus" class="cb-item" type="checkbox"
                                                                value="hoodie" hidden>Hoodie <span
                                                                class="glyphicon"></span>
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label>
                                                            <input name="cbStatus" class="cb-item" type="checkbox"
                                                                value="socks" hidden>Socks | Vớ <span
                                                                class="glyphicon"></span>
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label>
                                                            <input name="cbStatus" class="cb-item" type="checkbox"
                                                                value="merchandise-sweatshirt" hidden>Merchandise
                                                            Sweatshirt <span class="glyphicon"></span>
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label>
                                                            <input name="cbStatus" class="cb-item" type="checkbox"
                                                                value="merchandise-tee" hidden>Merchandise Tee <span
                                                                class="glyphicon"></span>
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label>
                                                            <input name="cbStatus" class="cb-item" type="checkbox"
                                                                value="grip-tape" hidden>Grip Tape <span
                                                                class="glyphicon"></span>
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label>
                                                            <input name="cbStatus" class="cb-item" type="checkbox"
                                                                value="deck" hidden>Deck <span class="glyphicon"></span>
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label>
                                                            <input name="cbStatus" class="cb-item" type="checkbox"
                                                                value="complete" hidden>Complete <span
                                                                class="glyphicon"></span>
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label>
                                                            <input name="cbStatus" class="cb-item" type="checkbox"
                                                                value="t-tool" hidden>T-Tool <span
                                                                class="glyphicon"></span>
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label>
                                                            <input name="cbStatus" class="cb-item" type="checkbox"
                                                                value="retro-football-jersey" hidden>Retro Football Jersey
                                                            <span class="glyphicon"></span>
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label>
                                                            <input name="cbStatus" class="cb-item" type="checkbox"
                                                                value="die-cut-insoles" hidden>Die-cut Insoles <span
                                                                class="glyphicon"></span>
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label>
                                                            <input name="cbStatus" class="cb-item" type="checkbox"
                                                                value="souvenir-ball" hidden>Souvenir Ball <span
                                                                class="glyphicon"></span>
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label>
                                                            <input name="cbStatus" class="cb-item" type="checkbox"
                                                                value="effect-tee" hidden>Effect Tee <span
                                                                class="glyphicon"></span>
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label>
                                                            <input name="cbStatus" class="cb-item" type="checkbox"
                                                                value="hip-pack" hidden>Hip Pack <span
                                                                class="glyphicon"></span>
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label>
                                                            <input name="cbStatus" class="cb-item" type="checkbox"
                                                                value="track-6" hidden>Track 6 <span
                                                                class="glyphicon"></span>
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label>
                                                            <input name="cbStatus" class="cb-item" type="checkbox"
                                                                value="basic-tee" hidden>Basic Tee <span
                                                                class="glyphicon"></span>
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label>
                                                            <input name="cbStatus" class="cb-item" type="checkbox"
                                                                value="shoelaces" hidden>Shoelaces <span
                                                                class="glyphicon"></span>
                                                        </label>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="nav-divider"></li>
                                            <li class="first-lvl">
                                                <label label-default="" class="tree-toggle nav-header orange">GIÁ<span
                                                        class="caret caret-active"></span></label>
                                                <ul class="nav tree">
                                                    <li>
                                                        <label>
                                                            <input name="cbStatus" class="cb-item" type="checkbox"
                                                                value="500-599k" hidden>500k - 599k <span
                                                                class="glyphicon"></span>
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label>
                                                            <input name="cbStatus" class="cb-item" type="checkbox"
                                                                value="600k" hidden>&gt; 600k <span
                                                                class="glyphicon"></span>
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label>
                                                            <input name="cbStatus" class="cb-item" type="checkbox"
                                                                value="400-499k" hidden>400k - 499k <span
                                                                class="glyphicon"></span>
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label>
                                                            <input name="cbStatus" class="cb-item" type="checkbox"
                                                                value="300-399k" hidden>300k - 399k <span
                                                                class="glyphicon"></span>
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label>
                                                            <input name="cbStatus" class="cb-item" type="checkbox"
                                                                value="200-299k" hidden>200k - 299k <span
                                                                class="glyphicon"></span>
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label>
                                                            <input name="cbStatus" class="cb-item" type="checkbox"
                                                                value="200k-range-price" hidden>&lt; 200k <span
                                                                class="glyphicon"></span>
                                                        </label>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="nav-divider"></li>
                                            <li class="first-lvl">
                                                <label label-default="" class="tree-toggle nav-header orange">BỘ SƯU
                                                    TẬP<span class="caret caret-active"></span></label>
                                                <ul class="nav tree">
                                                    <li>
                                                        <label>
                                                            <input name="cbStatus" class="cb-item" type="checkbox"
                                                                value="axgc-logo" hidden>AXGC Logo <span
                                                                class="glyphicon"></span>
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label>
                                                            <input name="cbStatus" class="cb-item" type="checkbox"
                                                                value="recycled-material" hidden>Recycled Material <span
                                                                class="glyphicon"></span>
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label>
                                                            <input name="cbStatus" class="cb-item" type="checkbox"
                                                                value="denim" hidden>Denim <span
                                                                class="glyphicon"></span>
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label>
                                                            <input name="cbStatus" class="cb-item" type="checkbox"
                                                                value="the-team" hidden>The Team <span
                                                                class="glyphicon"></span>
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label>
                                                            <input name="cbStatus" class="cb-item" type="checkbox"
                                                                value="day-slide" hidden>Day Slide <span
                                                                class="glyphicon"></span>
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label>
                                                            <input name="cbStatus" class="cb-item" type="checkbox"
                                                                value="randomly" hidden>Randomly <span
                                                                class="glyphicon"></span>
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label>
                                                            <input name="cbStatus" class="cb-item" type="checkbox"
                                                                value="public-2000s" hidden>Public 2000s <span
                                                                class="glyphicon"></span>
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label>
                                                            <input name="cbStatus" class="cb-item" type="checkbox"
                                                                value="ananas-global-goal" hidden>Ananas Global Goal <span
                                                                class="glyphicon"></span>
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label>
                                                            <input name="cbStatus" class="cb-item" type="checkbox"
                                                                value="vivu" hidden>Vivu <span
                                                                class="glyphicon"></span>
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label>
                                                            <input name="cbStatus" class="cb-item" type="checkbox"
                                                                value="ananas-daily-things" hidden>Ananas Daily Things
                                                            <span class="glyphicon"></span>
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label>
                                                            <input name="cbStatus" class="cb-item" type="checkbox"
                                                                value="nauda" hidden>Nauda <span
                                                                class="glyphicon"></span>
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label>
                                                            <input name="cbStatus" class="cb-item" type="checkbox"
                                                                value="ananas-music-fest-2023" hidden>Ananas Music Fest
                                                            2023 <span class="glyphicon"></span>
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label>
                                                            <input name="cbStatus" class="cb-item" type="checkbox"
                                                                value="tom" hidden>Tomo <span
                                                                class="glyphicon"></span>
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label>
                                                            <input name="cbStatus" class="cb-item" type="checkbox"
                                                                value="ananas-puppet-club" hidden>Ananas Puppet Club <span
                                                                class="glyphicon"></span>
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label>
                                                            <input name="cbStatus" class="cb-item" type="checkbox"
                                                                value="2-blues" hidden>2.Blues <span
                                                                class="glyphicon"></span>
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label>
                                                            <input name="cbStatus" class="cb-item" type="checkbox"
                                                                value="ananas-outline-typo" hidden>Ananas Outline Typo
                                                            <span class="glyphicon"></span>
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label>
                                                            <input name="cbStatus" class="cb-item" type="checkbox"
                                                                value="jazico" hidden>Jazico <span
                                                                class="glyphicon"></span>
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label>
                                                            <input name="cbStatus" class="cb-item" type="checkbox"
                                                                value="track-6-isee" hidden>I.S.E.E <span
                                                                class="glyphicon"></span>
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label>
                                                            <input name="cbStatus" class="cb-item" type="checkbox"
                                                                value="soda-pop" hidden>Soda Pop <span
                                                                class="glyphicon"></span>
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label>
                                                            <input name="cbStatus" class="cb-item" type="checkbox"
                                                                value="landforms" hidden>Landforms <span
                                                                class="glyphicon"></span>
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label>
                                                            <input name="cbStatus" class="cb-item" type="checkbox"
                                                                value="solid-colors" hidden>SC <span
                                                                class="glyphicon"></span>
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label>
                                                            <input name="cbStatus" class="cb-item" type="checkbox"
                                                                value="ananas-copy-store-bag" hidden>Ananas "Copy" Store
                                                            Bag <span class="glyphicon"></span>
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label>
                                                            <input name="cbStatus" class="cb-item" type="checkbox"
                                                                value="workaday" hidden>Workaday <span
                                                                class="glyphicon"></span>
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label>
                                                            <input name="cbStatus" class="cb-item" type="checkbox"
                                                                value="evergreen-pack" hidden>Evergreen <span
                                                                class="glyphicon"></span>
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label>
                                                            <input name="cbStatus" class="cb-item" type="checkbox"
                                                                value="raw" hidden>RAW <span
                                                                class="glyphicon"></span>
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label>
                                                            <input name="cbStatus" class="cb-item" type="checkbox"
                                                                value="polka-dots" hidden>Polka Dots <span
                                                                class="glyphicon"></span>
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label>
                                                            <input name="cbStatus" class="cb-item" type="checkbox"
                                                                value="retrospective" hidden>Retrospective <span
                                                                class="glyphicon"></span>
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label>
                                                            <input name="cbStatus" class="cb-item" type="checkbox"
                                                                value="aunter" hidden>Aunter <span
                                                                class="glyphicon"></span>
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label>
                                                            <input name="cbStatus" class="cb-item" type="checkbox"
                                                                value="ruler" hidden>Ruler <span
                                                                class="glyphicon"></span>
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label>
                                                            <input name="cbStatus" class="cb-item" type="checkbox"
                                                                value="flannel-pack" hidden>Flannel <span
                                                                class="glyphicon"></span>
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label>
                                                            <input name="cbStatus" class="cb-item" type="checkbox"
                                                                value="class-e" hidden>Class E <span
                                                                class="glyphicon"></span>
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label>
                                                            <input name="cbStatus" class="cb-item" type="checkbox"
                                                                value="loveplus" hidden>Love+ <span
                                                                class="glyphicon"></span>
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label>
                                                            <input name="cbStatus" class="cb-item" type="checkbox"
                                                                value="ananas-doraemon-50years" hidden>Ananas x Doraemon
                                                            50 Years <span class="glyphicon"></span>
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label>
                                                            <input name="cbStatus" class="cb-item" type="checkbox"
                                                                value="discoveryou" hidden>DiscoverYou <span
                                                                class="glyphicon"></span>
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label>
                                                            <input name="cbStatus" class="cb-item" type="checkbox"
                                                                value="ananas-typo-logo" hidden>Ananas Typo Logo <span
                                                                class="glyphicon"></span>
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label>
                                                            <input name="cbStatus" class="cb-item" type="checkbox"
                                                                value="og" hidden>OG <span class="glyphicon"></span>
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label>
                                                            <input name="cbStatus" class="cb-item" type="checkbox"
                                                                value="all-suede" hidden>All Suede <span
                                                                class="glyphicon"></span>
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label>
                                                            <input name="cbStatus" class="cb-item" type="checkbox"
                                                                value="corluray" hidden>Corluray <span
                                                                class="glyphicon"></span>
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label>
                                                            <input name="cbStatus" class="cb-item" type="checkbox"
                                                                value="simple-life" hidden>Simple Life <span
                                                                class="glyphicon"></span>
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label>
                                                            <input name="cbStatus" class="cb-item" type="checkbox"
                                                                value="mono-black" hidden>Mono Black <span
                                                                class="glyphicon"></span>
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label>
                                                            <input name="cbStatus" class="cb-item" type="checkbox"
                                                                value="hook-n-loop" hidden>Hook n' Loop <span
                                                                class="glyphicon"></span>
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label>
                                                            <input name="cbStatus" class="cb-item" type="checkbox"
                                                                value="bumper-gum" hidden>Bumper Gum <span
                                                                class="glyphicon"></span>
                                                        </label>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="nav-divider"></li>
                                            <li class="first-lvl">
                                                <label label-default="" class="tree-toggle nav-header orange">CHẤT
                                                    LIỆU<span class="caret caret-active"></span></label>
                                                <ul class="nav tree">
                                                    <li>
                                                        <label>
                                                            <input name="cbStatus" class="cb-item" type="checkbox"
                                                                value="canvas" hidden>Canvas <span
                                                                class="glyphicon"></span>
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label>
                                                            <input name="cbStatus" class="cb-item" type="checkbox"
                                                                value="suede" hidden>Suede | Da lộn <span
                                                                class="glyphicon"></span>
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label>
                                                            <input name="cbStatus" class="cb-item" type="checkbox"
                                                                value="pu" hidden>Synthetic Leather <span
                                                                class="glyphicon"></span>
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label>
                                                            <input name="cbStatus" class="cb-item" type="checkbox"
                                                                value="leather" hidden>Leather | Da <span
                                                                class="glyphicon"></span>
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label>
                                                            <input name="cbStatus" class="cb-item" type="checkbox"
                                                                value="cotton" hidden>Cotton <span
                                                                class="glyphicon"></span>
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label>
                                                            <input name="cbStatus" class="cb-item" type="checkbox"
                                                                value="pp" hidden>PP <span class="glyphicon"></span>
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label>
                                                            <input name="cbStatus" class="cb-item" type="checkbox"
                                                                value="steel" hidden>Steel <span
                                                                class="glyphicon"></span>
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label>
                                                            <input name="cbStatus" class="cb-item" type="checkbox"
                                                                value="paper" hidden>Paper <span
                                                                class="glyphicon"></span>
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label>
                                                            <input name="cbStatus" class="cb-item" type="checkbox"
                                                                value="aluminium" hidden>Aluminium <span
                                                                class="glyphicon"></span>
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label>
                                                            <input name="cbStatus" class="cb-item" type="checkbox"
                                                                value="canadian-maple" hidden>Canadian Maple <span
                                                                class="glyphicon"></span>
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label>
                                                            <input name="cbStatus" class="cb-item" type="checkbox"
                                                                value="ortholite-recycled-foam" hidden>Ortholite Recycled
                                                            Foam <span class="glyphicon"></span>
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label>
                                                            <input name="cbStatus" class="cb-item" type="checkbox"
                                                                value="denim-material" hidden>Denim <span
                                                                class="glyphicon"></span>
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label>
                                                            <input name="cbStatus" class="cb-item" type="checkbox"
                                                                value="taslan" hidden>Taslan <span
                                                                class="glyphicon"></span>
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label>
                                                            <input name="cbStatus" class="cb-item" type="checkbox"
                                                                value="knit" hidden>Knit <span
                                                                class="glyphicon"></span>
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label>
                                                            <input name="cbStatus" class="cb-item" type="checkbox"
                                                                value="ripstop" hidden>Ripstop <span
                                                                class="glyphicon"></span>
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label>
                                                            <input name="cbStatus" class="cb-item" type="checkbox"
                                                                value="single-jersey" hidden>Single Jersey <span
                                                                class="glyphicon"></span>
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label>
                                                            <input name="cbStatus" class="cb-item" type="checkbox"
                                                                value="terry" hidden>Terry <span
                                                                class="glyphicon"></span>
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label>
                                                            <input name="cbStatus" class="cb-item" type="checkbox"
                                                                value="flannel" hidden>Flannel <span
                                                                class="glyphicon"></span>
                                                        </label>
                                                    </li>
                                                    <li>
                                                        <label>
                                                            <input name="cbStatus" class="cb-item" type="checkbox"
                                                                value="corduroy" hidden>Corduroy <span
                                                                class="glyphicon"></span>
                                                        </label>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="nav-divider"></li>
                                            <!-- Content Color -->
                                            <li class="first-lvl">
                                                <label label-default="" class="tree-toggle nav-header orange">MÀU
                                                    SẮC<span class="caret caret-active"></span></label>
                                                <ul class="nav tree">
                                                    <li class="cb-color">
                                                        <label><span class="bg-color"
                                                                style="background-color: #Materialcolor;"></span><input
                                                                name="cbColor" type="checkbox" value="material-color"
                                                                hidden></label>
                                                        <label><span class="bg-color"
                                                                style="background-color: #Transparentcolor;"></span><input
                                                                name="cbColor" type="checkbox"
                                                                value="transparent-color" hidden></label>
                                                        <label><span class="bg-color"
                                                                style="background-color: #a49c8e;"></span><input
                                                                name="cbColor" type="checkbox" value="goat"
                                                                hidden></label>
                                                        <label><span class="bg-color"
                                                                style="background-color: #Multicolor;"></span><input
                                                                name="cbColor" type="checkbox" value="multi-color"
                                                                hidden></label>
                                                        <label><span class="bg-color"
                                                                style="background-color: #fefbef;"></span><input
                                                                name="cbColor" type="checkbox" value="offwhite"
                                                                hidden></label>
                                                        <label><span class="bg-color"
                                                                style="background-color: #455851;"></span><input
                                                                name="cbColor" type="checkbox" value="pineneedle"
                                                                hidden></label>
                                                        <label><span class="bg-color"
                                                                style="background-color: #006964;"></span><input
                                                                name="cbColor" type="checkbox" value="teal-color"
                                                                hidden></label>
                                                        <label><span class="bg-color"
                                                                style="background-color: #ebd0a2;"></span><input
                                                                name="cbColor" type="checkbox" value="beige"
                                                                hidden></label>
                                                        <label><span class="bg-color"
                                                                style="background-color: #c3c3c3;"></span><input
                                                                name="cbColor" type="checkbox" value="grey"
                                                                hidden></label>
                                                        <label><span class="bg-color"
                                                                style="background-color: #1c487c;"></span><input
                                                                name="cbColor" type="checkbox" value="navy"
                                                                hidden></label>
                                                        <label><span class="bg-color"
                                                                style="background-color: #865439;"></span><input
                                                                name="cbColor" type="checkbox" value="brown"
                                                                hidden></label>
                                                        <label><span class="bg-color"
                                                                style="background-color: #ffffff;"></span><input
                                                                name="cbColor" type="checkbox" value="white"
                                                                hidden></label>
                                                        <label><span class="bg-color"
                                                                style="background-color: #6d9951;"></span><input
                                                                name="cbColor" type="checkbox" value="green"
                                                                hidden></label>
                                                        <label><span class="bg-color"
                                                                style="background-color: #8a5ca0;"></span><input
                                                                name="cbColor" type="checkbox" value="violet"
                                                                hidden></label>
                                                        <label><span class="bg-color"
                                                                style="background-color: #f1778a;"></span><input
                                                                name="cbColor" type="checkbox" value="pink"
                                                                hidden></label>
                                                        <label><span class="bg-color"
                                                                style="background-color: #f5d255;"></span><input
                                                                name="cbColor" type="checkbox" value="yellow"
                                                                hidden></label>
                                                        <label><span class="bg-color"
                                                                style="background-color: #e9662c;"></span><input
                                                                name="cbColor" type="checkbox" value="orange"
                                                                hidden></label>
                                                        <label><span class="bg-color"
                                                                style="background-color: #c10013;"></span><input
                                                                name="cbColor" type="checkbox" value="red"
                                                                hidden></label>
                                                        <label><span class="bg-color"
                                                                style="background-color: #464646;"></span><input
                                                                name="cbColor" type="checkbox" value="black"
                                                                hidden></label>
                                                    </li>
                                                </ul>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="col-xs-6 col-sm-6 btn-clear fixed hidden">XÓA CHỌN</div>
                                <div class="col-xs-6 col-sm-6 btn-filter fixed hidden">LỌC</div>
                            </div>
                            <!-- End Content Section1 -->

                        </div>
                    </div>
                </div> <!-- END FILTER ON MOBILE VERSION -->
                <div class="row prd1-right-items">
                    <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4 item">
                        <div class="thumbnail">
                            <div class="cont-item">
                                <a href="../product-detail/xcs001/index.html">
                                    {{-- <img class="inormal" src="{{ asset('assetsClients/wp-content/uploads/hinh-anh-gai-xinh-tiktok-dep-01.jpg') }}"> --}}
                                    {{-- <img class="ihover" src="{{ asset('assetsClients/wp-content/uploads/hinh-anh-gai-xinh-tiktok-dep-01.jpg') }}"> --}}
                                </a>
                            </div>
                            <div class="button">
                                <a class="btn btn-prd1-buynow hidden-xs hidden-sm"
                                    href="../product-detail/xcs001/index.html">MUA
                                    NGAY</a>
                                <a class="btn btn-prd1-heart addToWishList" href="javascript:void(0)"
                                    data-liked="false" data-action="transferCartToWishList"
                                    data-idProduct="962153"></a>
                            </div>
                            <div class="caption">
                                <h3 class="type">New Arrival</h3>
                                <h3 class="divider"></h3>
                                <h3 class="name"><a href="../product-detail/xcs001/index.html">AXGC Basic Complete -
                                        Latex Glue</a>
                                </h3>
                                <h3 class="color">Material Color</h3>
                                <h3 class="price">
                                    1.400.000 VND </h3>
                            </div>
                        </div>
                    </div>

                    <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4 item">
                        <div class="thumbnail">
                            <div class="cont-item">
                                <a href="../product-detail/xcs002/index.html">
                                    {{-- <img class="inormal"
                                        src="{{ asset('assetsClients/wp-content/uploads/hinh-anh-gai-xinh-tiktok-dep-01.jpg') }}"> --}}
                                    {{-- <img class="ihover"
                                        src="{{ asset('assetsClients/wp-content/uploads/hinh-anh-gai-xinh-tiktok-dep-01.jpg') }}"> --}}
                                </a>
                            </div>
                            <div class="button">
                                <a class="btn btn-prd1-buynow hidden-xs hidden-sm"
                                    href="../product-detail/xcs002/index.html">MUA
                                    NGAY</a>
                                <a class="btn btn-prd1-heart addToWishList" href="javascript:void(0)"
                                    data-liked="false" data-action="transferCartToWishList"
                                    data-idProduct="962152"></a>
                            </div>
                            <div class="caption">
                                <h3 class="type">New Arrival</h3>
                                <h3 class="divider"></h3>
                                <h3 class="name"><a href="../product-detail/xcs002/index.html">AXGC Basic Complete -
                                        Epoxy Glue</a>
                                </h3>
                                <h3 class="color">Material Color</h3>
                                <h3 class="price">
                                    1.600.000 VND </h3>
                            </div>
                        </div>
                    </div>

                    <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4 item">
                        <div class="thumbnail">
                            <div class="cont-item">
                                <a href="../product-detail/a6f001/index.html">
                                    {{-- <img class="inormal"
                                        src="{{ asset('assetsClients/wp-content/uploads/hinh-anh-gai-xinh-tiktok-dep-01.jpg') }}">
                                    <img class="ihover"
                                        src="{{ asset('assetsClients/wp-content/uploads/hinh-anh-gai-xinh-tiktok-dep-01.jpg') }}"> --}}
                                </a>
                            </div>
                            <div class="button">
                                <a class="btn btn-prd1-buynow hidden-xs hidden-sm"
                                    href="../product-detail/a6f001/index.html">MUA
                                    NGAY</a>
                                <a class="btn btn-prd1-heart addToWishList" href="javascript:void(0)"
                                    data-liked="false" data-action="transferCartToWishList"
                                    data-idProduct="1120819"></a>
                            </div>
                            <div class="caption">
                                <h3 class="type">New Arrival</h3>
                                <h3 class="divider"></h3>
                                <h3 class="name"><a href="../product-detail/a6f001/index.html">Track 6 Fold-over
                                        Tongue - The Team - Low Top</a>
                                </h3>
                                <h3 class="color">Caviar Black</h3>
                                <h3 class="price">
                                    1.090.000 VND </h3>
                            </div>
                        </div>
                    </div>

                    <div class="item-break"></div>
                    <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4 item">
                        <div class="thumbnail">
                            <div class="cont-item">
                                <div class="soldout-text">HẾT HÀNG</div>
                                <div class="black-rect"></div>
                                <a href="../product-detail/frj0002/index.html">
                                    <img class="inormal" src="../wp-content/uploads/Pro_FRJ0002_1-500x500.jpg">
                                    <img class="ihover" src="../wp-content/uploads/Pro_FRJ0002_4-500x500.jpg">
                                </a>
                            </div>
                            <div class="button">
                                <a class="btn btn-prd1-heart addToWishList" href="javascript:void(0)"
                                    data-liked="false" data-action="transferCartToWishList"
                                    data-idProduct="1081708"></a>
                            </div>
                            <div class="caption">
                                <h3 class="type">Online Only</h3>
                                <h3 class="divider"></h3>
                                <h3 class="name"><a href="../product-detail/frj0002/index.html">Retro Football Jersey
                                        - Vietnam 95 - Việt Nam 2</a>
                                </h3>
                                <h3 class="color">Lemon</h3>
                                <h3 class="price">
                                    650.000 VND </h3>
                            </div>
                        </div>
                    </div>

                    <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4 item">
                        <div class="thumbnail">
                            <div class="cont-item">
                                <a href="../product-detail/frj0001/index.html">
                                    <img class="inormal" src="../wp-content/uploads/Pro_FRJ0001_1-500x500.jpg">
                                    <img class="ihover" src="../wp-content/uploads/Pro_FRJ0001_4-500x500.jpg">
                                </a>
                            </div>
                            <div class="button">
                                <a class="btn btn-prd1-buynow hidden-xs hidden-sm"
                                    href="../product-detail/frj0001/index.html">MUA
                                    NGAY</a>
                                <a class="btn btn-prd1-heart addToWishList" href="javascript:void(0)"
                                    data-liked="false" data-action="transferCartToWishList"
                                    data-idProduct="1080225"></a>
                            </div>
                            <div class="caption">
                                <h3 class="type">Online Only</h3>
                                <h3 class="divider"></h3>
                                <h3 class="name"><a href="../product-detail/frj0001/index.html">Retro Football Jersey
                                        - Vietnam 95 - Việt Nam 1</a>
                                </h3>
                                <h3 class="color">High Risk Red</h3>
                                <h3 class="price">
                                    650.000 VND </h3>
                            </div>
                        </div>
                    </div>

                    <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4 item">
                        <div class="thumbnail">
                            <div class="cont-item">
                                <a href="../product-detail/adi001/index.html">
                                    <img class="inormal" src="../wp-content/uploads/Pro_ADI001_S_2-500x500.jpg">
                                    <img class="ihover" src="../wp-content/uploads/Pro_ADI001_S_1-500x500.jpg">
                                </a>
                            </div>
                            <div class="button">
                                <a class="btn btn-prd1-buynow hidden-xs hidden-sm"
                                    href="../product-detail/adi001/index.html">MUA
                                    NGAY</a>
                                <a class="btn btn-prd1-heart addToWishList" href="javascript:void(0)"
                                    data-liked="false" data-action="transferCartToWishList"
                                    data-idProduct="1024090"></a>
                            </div>
                            <div class="caption">
                                <h3 class="name"><a href="../product-detail/adi001/index.html">Die-cut Insoles -
                                        Ananas Ortholite 7mm RF</a>
                                </h3>
                                <h3 class="color">White Asparagus</h3>
                                <h3 class="price">
                                    69.000 VND </h3>
                            </div>
                        </div>
                    </div>

                    <div class="item-break"></div>
                    <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4 item">
                        <div class="thumbnail">
                            <div class="cont-item">
                                <a href="../product-detail/av00214/index.html">
                                    {{-- <img class="inormal"
                                        src="{{ asset('assetsClients/wp-content/uploads/hinh-anh-gai-xinh-tiktok-dep-01.jpg') }}">
                                    <img class="ihover"
                                        src="{{ asset('assetsClients/wp-content/uploads/hinh-anh-gai-xinh-tiktok-dep-01.jpg') }}"> --}}
                                </a>
                            </div>
                            <div class="button">
                                <a class="btn btn-prd1-buynow hidden-xs hidden-sm"
                                    href="../product-detail/av00214/index.html">MUA
                                    NGAY</a>
                                <a class="btn btn-prd1-heart addToWishList" href="javascript:void(0)"
                                    data-liked="false" data-action="transferCartToWishList"
                                    data-idProduct="1033500"></a>
                            </div>
                            <div class="caption">
                                <h3 class="name"><a href="../product-detail/av00214/index.html">Vintas Denim - Low
                                        Top</a>
                                </h3>
                                <h3 class="color">Night Sky</h3>
                                <h3 class="price">
                                    650.000 VND </h3>
                            </div>
                        </div>
                    </div>

                    <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4 item">
                        <div class="thumbnail">
                            <div class="cont-item">
                                <a href="../product-detail/av00212/index.html">
                                    {{-- <img class="inormal"
                                        src="{{ asset('assetsClients/wp-content/uploads/hinh-anh-gai-xinh-tiktok-dep-01.jpg') }}">
                                    <img class="ihover"
                                        src="{{ asset('assetsClients/wp-content/uploads/hinh-anh-gai-xinh-tiktok-dep-01.jpg') }}"> --}}
                                </a>
                            </div>
                            <div class="button">
                                <a class="btn btn-prd1-buynow hidden-xs hidden-sm"
                                    href="../product-detail/av00212/index.html">MUA
                                    NGAY</a>
                                <a class="btn btn-prd1-heart addToWishList" href="javascript:void(0)"
                                    data-liked="false" data-action="transferCartToWishList"
                                    data-idProduct="1033502"></a>
                            </div>
                            <div class="caption">
                                <h3 class="name"><a href="../product-detail/av00212/index.html">Vintas Denim - Low
                                        Top</a>
                                </h3>
                                <h3 class="color">Night Sky</h3>
                                <h3 class="price">
                                    650.000 VND </h3>
                            </div>
                        </div>
                    </div>

                    <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4 item">
                        <div class="thumbnail">
                            <div class="cont-item">
                                <a href="../product-detail/av00213/index.html">
                                    {{-- <img class="inormal"
                                        src="{{ asset('assetsClients/wp-content/uploads/hinh-anh-gai-xinh-tiktok-dep-01.jpg') }}">
                                    <img class="ihover"
                                        src="{{ asset('assetsClients/wp-content/uploads/hinh-anh-gai-xinh-tiktok-dep-01.jpg') }}"> --}}
                                </a>
                            </div>
                            <div class="button">
                                <a class="btn btn-prd1-buynow hidden-xs hidden-sm"
                                    href="../product-detail/av00213/index.html">MUA
                                    NGAY</a>
                                <a class="btn btn-prd1-heart addToWishList" href="javascript:void(0)"
                                    data-liked="false" data-action="transferCartToWishList"
                                    data-idProduct="1033501"></a>
                            </div>
                            <div class="caption">
                                <h3 class="name"><a href="../product-detail/av00213/index.html">Vintas Denim - High
                                        Top</a>
                                </h3>
                                <h3 class="color">Night Sky</h3>
                                <h3 class="price">
                                    690.000 VND </h3>
                            </div>
                        </div>
                    </div>

                    <div class="item-break"></div>
                    <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4 item">
                        <div class="thumbnail">
                            <div class="cont-item">
                                <div class="tag-blue">Limited Edition</div>
                                <div class="soldout-text">HẾT HÀNG</div>
                                <div class="black-rect"></div>
                                <a href="../product-detail/alp2401/index.html">
                                    <img class="inormal" src="../wp-content/uploads/Pro_ALP2401_1-500x500.jpg">
                                    <img class="ihover" src="../wp-content/uploads/Pro_ALP2401_5-500x500.jpg">
                                </a>
                            </div>
                            <div class="button">
                                <a class="btn btn-prd1-heart addToWishList" href="javascript:void(0)"
                                    data-liked="false" data-action="transferCartToWishList"
                                    data-idProduct="1034326"></a>
                            </div>
                            <div class="caption">
                                <h3 class="name"><a href="../product-detail/alp2401/index.html">Urbas Love+ 24</a>
                                </h3>
                                <h3 class="color">Oyster White</h3>
                                <h3 class="price">
                                    650.000 VND </h3>
                            </div>
                        </div>
                    </div>

                    <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4 item">
                        <div class="thumbnail">
                            <div class="cont-item">
                                <div class="tag-blue">Limited Edition</div>
                                <div class="soldout-text">HẾT HÀNG</div>
                                <div class="black-rect"></div>
                                <a href="../product-detail/alp2402/index.html">
                                    <img class="inormal" src="../wp-content/uploads/Pro_ALP2402_1-1-500x500.jpg">
                                    <img class="ihover" src="../wp-content/uploads/Pro_ALP2402_5-1-500x500.jpg">
                                </a>
                            </div>
                            <div class="button">
                                <a class="btn btn-prd1-heart addToWishList" href="javascript:void(0)"
                                    data-liked="false" data-action="transferCartToWishList"
                                    data-idProduct="1034325"></a>
                            </div>
                            <div class="caption">
                                <h3 class="name"><a href="../product-detail/alp2402/index.html">Urbas Love+ 24</a>
                                </h3>
                                <h3 class="color">Oyster White</h3>
                                <h3 class="price">
                                    650.000 VND </h3>
                            </div>
                        </div>
                    </div>

                    <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4 item">
                        <div class="thumbnail">
                            <div class="cont-item">
                                <a href="../product-detail/av00205/index.html">
                                    <img class="inormal" src="../wp-content/uploads/Pro_AV00205_1-500x500.jpg">
                                    <img class="ihover" src="../wp-content/uploads/Pro_AV00205_2-500x500.jpg">
                                </a>
                            </div>
                            <div class="button">
                                <a class="btn btn-prd1-buynow hidden-xs hidden-sm"
                                    href="../product-detail/av00205/index.html">MUA
                                    NGAY</a>
                                <a class="btn btn-prd1-heart addToWishList" href="javascript:void(0)"
                                    data-liked="false" data-action="transferCartToWishList"
                                    data-idProduct="899186"></a>
                            </div>
                            <div class="caption">
                                <h3 class="name"><a href="../product-detail/av00205/index.html">Vintas Vivu - Low
                                        Top</a>
                                </h3>
                                <h3 class="color">Warm Sand</h3>
                                <h3 class="price">
                                    620.000 VND </h3>
                            </div>
                        </div>
                    </div>

                    <div class="item-break"></div>
                    <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4 item">
                        <div class="thumbnail">
                            <div class="cont-item">
                                <a href="../product-detail/av00206/index.html">
                                    <img class="inormal" src="../wp-content/uploads/Pro_AV00206_1-500x500.jpg">
                                    <img class="ihover" src="../wp-content/uploads/Pro_AV00206_2-500x500.jpg">
                                </a>
                            </div>
                            <div class="button">
                                <a class="btn btn-prd1-buynow hidden-xs hidden-sm"
                                    href="../product-detail/av00206/index.html">MUA
                                    NGAY</a>
                                <a class="btn btn-prd1-heart addToWishList" href="javascript:void(0)"
                                    data-liked="false" data-action="transferCartToWishList"
                                    data-idProduct="899185"></a>
                            </div>
                            <div class="caption">
                                <h3 class="name"><a href="../product-detail/av00206/index.html">Vintas Vivu - Low
                                        Top</a>
                                </h3>
                                <h3 class="color">Plantation</h3>
                                <h3 class="price">
                                    620.000 VND </h3>
                            </div>
                        </div>
                    </div>

                    <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4 item">
                        <div class="thumbnail">
                            <div class="cont-item">
                                <a href="../product-detail/av00204/index.html">
                                    <img class="inormal" src="../wp-content/uploads/Pro_AV00204_1-500x500.jpg">
                                    <img class="ihover" src="../wp-content/uploads/Pro_AV00204_2-500x500.jpg">
                                </a>
                            </div>
                            <div class="button">
                                <a class="btn btn-prd1-buynow hidden-xs hidden-sm"
                                    href="../product-detail/av00204/index.html">MUA
                                    NGAY</a>
                                <a class="btn btn-prd1-heart addToWishList" href="javascript:void(0)"
                                    data-liked="false" data-action="transferCartToWishList"
                                    data-idProduct="899187"></a>
                            </div>
                            <div class="caption">
                                <h3 class="name"><a href="../product-detail/av00204/index.html">Vintas Nauda EXT -
                                        High Top</a>
                                </h3>
                                <h3 class="color">Monk's Robe</h3>
                                <h3 class="price">
                                    720.000 VND </h3>
                            </div>
                        </div>
                    </div>

                    <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4 item">
                        <div class="thumbnail">
                            <div class="cont-item">
                                <a href="../product-detail/av00203/index.html">
                                    <img class="inormal" src="../wp-content/uploads/Pro_AV00203_1-500x500.jpg">
                                    <img class="ihover" src="../wp-content/uploads/Pro_AV00203_2-500x500.jpg">
                                </a>
                            </div>
                            <div class="button">
                                <a class="btn btn-prd1-buynow hidden-xs hidden-sm"
                                    href="../product-detail/av00203/index.html">MUA
                                    NGAY</a>
                                <a class="btn btn-prd1-heart addToWishList" href="javascript:void(0)"
                                    data-liked="false" data-action="transferCartToWishList"
                                    data-idProduct="775846"></a>
                            </div>
                            <div class="caption">
                                <h3 class="name"><a href="../product-detail/av00203/index.html">Vintas Nauda EXT - Low
                                        Top</a>
                                </h3>
                                <h3 class="color">Monk's Robe</h3>
                                <h3 class="price">
                                    650.000 VND </h3>
                            </div>
                        </div>
                    </div>

                    <div class="item-break"></div>
                    <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4 item">
                        <div class="thumbnail">
                            <div class="cont-item">
                                <div class="tag-grey">Online Only</div>
                                <a href="../product-detail/av00158/index.html">
                                    <img class="inormal" src="../wp-content/uploads/pro_AV00158_1-500x500.jpg">
                                    <img class="ihover" src="../wp-content/uploads/pro_AV00158_2-500x500.jpg">
                                </a>
                            </div>
                            <div class="button">
                                <a class="btn btn-prd1-buynow hidden-xs hidden-sm"
                                    href="../product-detail/av00158/index.html">MUA
                                    NGAY</a>
                                <a class="btn btn-prd1-heart addToWishList" href="javascript:void(0)"
                                    data-liked="false" data-action="transferCartToWishList"
                                    data-idProduct="706001"></a>
                            </div>
                            <div class="caption">
                                <h3 class="type">Sale off</h3>
                                <h3 class="divider"></h3>
                                <h3 class="name"><a href="../product-detail/av00158/index.html">Pattas Polka Dots -
                                        High Top</a>
                                </h3>
                                <h3 class="color">Offwhite</h3>
                                <h3 class="price">
                                    390.000 VND <span class="price-real">750.000 VND</span>
                                </h3>
                            </div>
                        </div>
                    </div>

                    <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4 item">
                        <div class="thumbnail">
                            <div class="cont-item">
                                <div class="tag-grey">Online Only</div>
                                <a href="../product-detail/av00171/index.html">
                                    <img class="inormal" src="../wp-content/uploads/pro_AV00171_1-500x500.jpg">
                                    <img class="ihover" src="../wp-content/uploads/pro_AV00171_2-500x500.jpg">
                                </a>
                            </div>
                            <div class="button">
                                <a class="btn btn-prd1-buynow hidden-xs hidden-sm"
                                    href="../product-detail/av00171/index.html">MUA
                                    NGAY</a>
                                <a class="btn btn-prd1-heart addToWishList" href="javascript:void(0)"
                                    data-liked="false" data-action="transferCartToWishList"
                                    data-idProduct="706000"></a>
                            </div>
                            <div class="caption">
                                <h3 class="type">Online Only</h3>
                                <h3 class="divider"></h3>
                                <h3 class="name"><a href="../product-detail/av00171/index.html">Pattas Polka Dots -
                                        Low Top</a>
                                </h3>
                                <h3 class="color">True Blue</h3>
                                <h3 class="price">
                                    390.000 VND <span class="price-real">720.000 VND</span>
                                </h3>
                            </div>
                        </div>
                    </div>

                    <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4 item">
                        <div class="thumbnail">
                            <div class="cont-item">
                                <div class="tag-grey">Online Only</div>
                                <a href="../product-detail/av00172/index.html">
                                    <img class="inormal" src="../wp-content/uploads/pro_AV00172_1-500x500.jpg">
                                    <img class="ihover" src="../wp-content/uploads/pro_AV00172_2-500x500.jpg">
                                </a>
                            </div>
                            <div class="button">
                                <a class="btn btn-prd1-buynow hidden-xs hidden-sm"
                                    href="../product-detail/av00172/index.html">MUA
                                    NGAY</a>
                                <a class="btn btn-prd1-heart addToWishList" href="javascript:void(0)"
                                    data-liked="false" data-action="transferCartToWishList"
                                    data-idProduct="705999"></a>
                            </div>
                            <div class="caption">
                                <h3 class="type">Sale off</h3>
                                <h3 class="divider"></h3>
                                <h3 class="name"><a href="../product-detail/av00172/index.html">Pattas Polka Dots -
                                        High Top</a>
                                </h3>
                                <h3 class="color">Jelly Bean</h3>
                                <h3 class="price">
                                    390.000 VND <span class="price-real">750.000 VND</span>
                                </h3>
                            </div>
                        </div>
                    </div>

                    <div class="item-break"></div>
                    <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4 item">
                        <div class="thumbnail">
                            <div class="cont-item">
                                <div class="tag-grey">Online Only</div>
                                <a href="../product-detail/av00159/index.html">
                                    <img class="inormal" src="../wp-content/uploads/Pro_AV00159_1-500x500.jpg">
                                    <img class="ihover" src="../wp-content/uploads/Pro_AV00159_2-1-500x500.jpg">
                                </a>
                            </div>
                            <div class="button">
                                <a class="btn btn-prd1-buynow hidden-xs hidden-sm"
                                    href="../product-detail/av00159/index.html">MUA
                                    NGAY</a>
                                <a class="btn btn-prd1-heart addToWishList" href="javascript:void(0)"
                                    data-liked="false" data-action="transferCartToWishList"
                                    data-idProduct="710279"></a>
                            </div>
                            <div class="caption">
                                <h3 class="type">Online Only</h3>
                                <h3 class="divider"></h3>
                                <h3 class="name"><a href="../product-detail/av00159/index.html">Pattas Polka Dots -
                                        Low Top</a>
                                </h3>
                                <h3 class="color">Coral Rose</h3>
                                <h3 class="price">
                                    390.000 VND <span class="price-real">720.000 VND</span>
                                </h3>
                            </div>
                        </div>
                    </div>

                    <div class="col-xs-6 col-sm-6 col-md-4 col-lg-4 item">
                        <div class="thumbnail">
                            <div class="cont-item">
                                <div class="tag-grey">Online Only</div>
                                <a href="../product-detail/av00157/index.html">
                                    <img class="inormal" src="../wp-content/uploads/pro_AV00157_1-500x500.jpg">
                                    <img class="ihover" src="../wp-content/uploads/pro_AV00157_2-500x500.jpg">
                                </a>
                            </div>
                            <div class="button">
                                <a class="btn btn-prd1-buynow hidden-xs hidden-sm"
                                    href="../product-detail/av00157/index.html">MUA
                                    NGAY</a>
                                <a class="btn btn-prd1-heart addToWishList" href="javascript:void(0)"
                                    data-liked="false" data-action="transferCartToWishList"
                                    data-idProduct="706002"></a>
                            </div>
                            <div class="caption">
                                <h3 class="type">Online Only</h3>
                                <h3 class="divider"></h3>
                                <h3 class="name"><a href="../product-detail/av00157/index.html">Pattas Polka Dots -
                                        Low Top</a>
                                </h3>
                                <h3 class="color">Black</h3>
                                <h3 class="price">
                                    390.000 VND <span class="price-real">720.000 VND</span>
                                </h3>
                            </div>
                        </div>
                    </div>

                </div>
                <div class="gotop hidden-xs hidden-sm">
                    <a href="#"><img src="../wp-content/themes/ananas/fe-assets/images/gotop.png"></a>
                </div>
                <div class="text-center load-more-icon">
                    <img src="../wp-content/themes/ananas/fe-assets/images/loading.gif">
                </div>

            </div>
            <input type="hidden" value="1" class="isProductListPage">
        </div>
    </div>
    <!-- END CONTENT -->
    <div class="templates">
        <div id="templatePopupYesNo">
            <div class="row message">
                BẠN CÓ CHẮC CHẮN MUỐN HUỶ ĐƠN HÀNG NÀY KHÔNG?
            </div>
            <div class="col-md-12">
                <div class="col-md-12">
                    <!--                Tôi muốn thêm/bớt danh sách sản phẩm cần mua.-->
                    <!--                Tôi muốn thay đổi thông tin giao hàng.-->
                    <!--                Tôi muốn thay đổi phương thức thanh toán.-->
                    <!--                Tôi muốn huỷ vì phải chờ giao hàng quá lâu.-->
                    <!--                Tôi muốn huỷ vì sản phẩm đến chậm hơn thời điểm tôi cần.-->
                    <!--                Tôi muốn huỷ đơn để tham gia chương trình khuyến mãi.-->
                    <!--                Tôi đổi ý không muốn mua nữa.-->
                    <!--                Lí do khác (hiện ra bảng điền text khi chọn lí do này).-->
                    <!--                <input id="message-cancel-order" type="text" class="form-control input-reason-cancel" required placeholder="Lý do hủy*" name="cancel-order">-->
                    <select required placeholder="Lý do hủy*" name="cancel-order"
                        class="selectpicker form-control select-reason-cancel">
                        <option selected disabled>Lý do huỷ</option>
                        <option value="Tôi chọn nhầm sản phẩm.">Tôi chọn nhầm sản phẩm.</option>
                        <option value="Tôi chọn nhầm size.">Tôi chọn nhầm size.</option>
                        <option value="Tôi muốn thêm/bớt danh sách sản phẩm cần mua.">Tôi muốn thêm/bớt danh sách sản phẩm
                            cần mua.</option>
                        <option value="Tôi muốn thay đổi thông tin giao hàng.">Tôi muốn thay đổi thông tin giao hàng.
                        </option>
                        <option value="Tôi muốn thay đổi phương thức thanh toán.">Tôi muốn thay đổi phương thức thanh
                            toán.</option>
                        <option value="Tôi muốn huỷ vì phải chờ giao hàng quá lâu.">Tôi muốn huỷ vì phải chờ giao hàng quá
                            lâu.</option>
                        <option value="Tôi muốn huỷ vì sản phẩm đến chậm hơn thời điểm tôi cần.">Tôi muốn huỷ vì sản phẩm
                            đến chậm hơn thời điểm tôi cần.</option>
                        <option value="Tôi muốn huỷ đơn để tham gia chương trình khuyến mãi.">Tôi muốn huỷ đơn để tham gia
                            chương trình khuyến mãi.</option>
                        <option value="Tôi đổi ý không muốn mua nữa.">Tôi đổi ý không muốn mua nữa.</option>
                        <option value="other-reason">Lí do khác</option>
                    </select>
                    <textarea class="form-control textarea-popup" placeholder="Viết lí do tại đây"></textarea>
                    <div class="error-popup-yes-no">*Vui lòng chọn chính xác lý do huỷ để chúng tôi hiểu và phục vụ bạn
                        tốt hơn.</div>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="row button btn-group-popup">
                <div class="col-xs-6 col-sm-6 col-md-6 align-left"><button class="btn btn-no form-control"
                        type="button">TỪ CHỐI</button></div>
                <div class="col-xs-6 col-sm-6 col-md-6 align-right"><button class="btn btn-yes form-control"
                        type="button" disabled>ĐỒNG Ý</button></div>
            </div>
        </div>

        <div id="templatePopupNotice">
            <div class="row message">EMAIL ĐÃ ĐƯỢC ĐĂNG KÝ THÀNH CÔNG</div>
            <div class="row button">
                <button class="btn btn-ok btn-redirect" type="button">QUAY LẠI TRANG CHỦ</button>
            </div>
        </div>
        <input type="hidden" id="home_url" value="../index.html">
    </div>
@endsection
