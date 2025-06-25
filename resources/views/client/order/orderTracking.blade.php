@extends('.client.layouts.main')
@section('content')
<div class="search-order container-fluid">
    <div class="row ">
        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 title-1">TRA CỨU ĐƠN HÀNG</div>

        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12" style="display: none;" id="message-error-search-order">
            <div class="item-notice">Xin lỗi! Hệ thống không tìm thấy đơn hàng bạn muốn tra cứu.<br> Vui lòng kiểm tra
                lại các thông tin đã nhập.
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 form-group">
            <div class="has-feedback">
                <input required type="text" class="form-control text-uppercase" placeholder="Mã đơn hàng" id="order-code">
                <span></span>
            </div>
        </div>

        <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 form-group">
            <div class="has-feedback">
                <input required type="text" class="form-control" placeholder="Email / Số điện thoại" id="input">
                <span></span>
            </div>
        </div>
        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 title-3">
            <button class="btn btn-search-order" data-userSearchOrder data-action="user-search-order">TRA CỨU ĐƠN HÀNG</button>
        </div>
        <div class="col-xs-0 col-sm-4 col-md-4 col-lg-4"></div>
        <div class="col-xs-12 col-sm-4 col-md-4 col-lg-4 title-3">
                    </div>
    </div>
</div><div class="templates">
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
                <select required placeholder="Lý do hủy*" name="cancel-order" class="selectpicker form-control select-reason-cancel">
                    <option selected disabled>Lý do huỷ</option>
                    <option value="Tôi chọn nhầm sản phẩm.">Tôi chọn nhầm sản phẩm.</option>
                    <option value="Tôi chọn nhầm size.">Tôi chọn nhầm size.</option>
                    <option value="Tôi muốn thêm/bớt danh sách sản phẩm cần mua.">Tôi muốn thêm/bớt danh sách sản phẩm cần mua.</option>
                    <option value="Tôi muốn thay đổi thông tin giao hàng.">Tôi muốn thay đổi thông tin giao hàng.</option>
                    <option value="Tôi muốn thay đổi phương thức thanh toán.">Tôi muốn thay đổi phương thức thanh toán.</option>
                    <option value="Tôi muốn huỷ vì phải chờ giao hàng quá lâu.">Tôi muốn huỷ vì phải chờ giao hàng quá lâu.</option>
                    <option value="Tôi muốn huỷ vì sản phẩm đến chậm hơn thời điểm tôi cần.">Tôi muốn huỷ vì sản phẩm đến chậm hơn thời điểm tôi cần.</option>
                    <option value="Tôi muốn huỷ đơn để tham gia chương trình khuyến mãi.">Tôi muốn huỷ đơn để tham gia chương trình khuyến mãi.</option>
                    <option value="Tôi đổi ý không muốn mua nữa.">Tôi đổi ý không muốn mua nữa.</option>
                    <option value="other-reason">Lí do khác</option>
                </select>
                <textarea class="form-control textarea-popup" placeholder="Viết lí do tại đây"></textarea>
                <div class="error-popup-yes-no">*Vui lòng chọn chính xác lý do huỷ để chúng tôi hiểu và phục vụ bạn tốt hơn.</div>
            </div>
        </div>
        <div class="clearfix"></div>
        <div class="row button btn-group-popup">
            <div class="col-xs-6 col-sm-6 col-md-6 align-left"><button class="btn btn-no form-control" type="button">TỪ CHỐI</button></div>
            <div class="col-xs-6 col-sm-6 col-md-6 align-right"><button class="btn btn-yes form-control" type="button" disabled>ĐỒNG Ý</button></div>
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