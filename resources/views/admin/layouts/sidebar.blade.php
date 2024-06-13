<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <a href="{{ route('admin.home') }}" class="brand-link">
        <img src="{{ asset('admin-assets/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">داشبورد ادمین</span>
    </a>

    <div class="sidebar">

        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="{{ asset('admin-assets/img/user2-160x160.jpg') }}" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="#" class="d-block">سعید نوری</a>
            </div>
        </div>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                <li class="nav-header">داشبورد</li>
                <li class="nav-item">
                    <a href="{{ route('admin.home') }}" class="nav-link ">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>داشبورد</p>
                    </a>
                </li>
                <li class="nav-header">مارکت</li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-box"></i>
                        <p>
                            کاتالوگ
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.market.category.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>دسته بندی</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.market.property.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>فرم کالا</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.market.brand.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>برند</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.market.product.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>محصولات</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.market.storage.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>موجودی</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.market.comment.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>نظرات</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-list"></i>
                        <p>
                            سفارشات
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.market.order.new') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>جدید</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.market.order.processing') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>درحال پردازش</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.market.order.unpaid') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>پرداخت نشده</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.market.order.canceled') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>لغو شده</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.market.order.returned') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>مرجوعی</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.market.order.all') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>تمام سفارشات</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-credit-card"></i>
                        <p>
                            پرداخت ها
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.market.payment.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>تمام پرداخت ها</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.market.payment.online') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>پرداخت های آنلاین</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.market.payment.offline') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>پرداخت های آفلاین</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.market.payment.cash') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>پرداخت در محل</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-percentage"></i>
                        <p>
                            کوپن ها
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.market.coupon.discount.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>تخفیفات</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.market.coupon.general.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>کوپن های عمومی</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.market.coupon.amazing.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>فروش شگفت انگیز</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.market.delivery.index') }}" class="nav-link ">
                        <i class="nav-icon fas fa-truck"></i>
                        <p>روش های ارسال</p>
                    </a>
                </li>
                <li class="nav-header">محتوا</li>

                @can('category-list')
                    <li class="nav-item">
                        <a href="{{ route('admin.content.category.index') }}" class="nav-link ">
                            <i class="nav-icon fas fa-th-list"></i>
                            <p>دسته بندی</p>
                        </a>
                    </li>
                @endcan

                <li class="nav-item">
                    <a href="{{ route('admin.content.post.index') }}" class="nav-link ">
                        <i class="nav-icon fas fa-sticky-note"></i>
                        <p>پست ها</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.content.comment.index') }}" class="nav-link ">
                        <i class="nav-icon fas fa-comments"></i>
                        <p>نظرات</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.content.menu.index') }}" class="nav-link ">
                        <i class="nav-icon fas fa-bars"></i>
                        <p>منو</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.content.faq.index') }}" class="nav-link ">
                        <i class="nav-icon fas fa-question-circle"></i>
                        <p>سوالات متداول</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.content.banner.index') }}" class="nav-link ">
                        <i class="nav-icon fas fa-pager"></i>
                        <p>بنر ها</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.content.page-builder.index') }}" class="nav-link ">
                        <i class="nav-icon fas fa-pager"></i>
                        <p>صفحه ساز</p>
                    </a>
                </li>
                <li class="nav-header">کاربران</li>
                <li class="nav-item">
                    <a href="{{ route('admin.user.admin.index') }}" class="nav-link ">
                        <i class="nav-icon fas fa-user-tie"></i>
                        <p>مدیران</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.user.customer.index') }}" class="nav-link ">
                        <i class="nav-icon fas fa-users"></i>
                        <p>مشتریان</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="" class="nav-link">
                        <i class="nav-icon fas fa-ticket-alt"></i>
                        <p>سطوح دسترسی<i class="fas fa-angle-left right"></i></p>
                    </a>
                    <ul class="nav nav-treeview">
                        <a href="{{ route('admin.user.role.index') }}" class="nav-link ">
                            <i class="far fa-circle nav-icon"></i>
                            <p>نقش ها</p>
                        </a>
                        <a href="{{ route('admin.user.permission.index') }}" class="nav-link ">
                            <i class="far fa-circle nav-icon"></i>
                            <p>مجوزها</p>
                        </a>
                    </ul>
                </li>
                <li class="nav-header">تیکت</li>
                <li class="nav-item">
                    <a href="" class="nav-link">
                        <i class="nav-icon fas fa-ticket-alt"></i>
                        <p>
                            تیکت ها
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.ticket.newTickets') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>تیکت جدید</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.ticket.openTickets') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>تیکت باز</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.ticket.closedTickets') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>تیکت بسته</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.ticket.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>تمام تیکت ها</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.ticket.category.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>دسته بندی</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.ticket.priority.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>اولویت ها</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.ticket.admin.index') }}" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>پاسخگویان</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <li class="nav-header">اعلانات</li>
                <li class="nav-item">
                    <a href="{{ route('admin.notify.email.index') }}" class="nav-link ">
                        <i class="nav-icon fas fa-envelope"></i>
                        <p>اعلان ایمیلی</p>
                    </a>
                </li>
                <li class="nav-item">
                    <a href="{{ route('admin.notify.sms.index') }}" class="nav-link ">
                        <i class="nav-icon fas fa-envelope-open-text"></i>
                        <p>اعلان پیامکی</p>
                    </a>
                </li>
                <li class="nav-header">تنظیمات</li>
                <li class="nav-item">
                    <a href="{{ route('admin.setting.index') }}" class="nav-link ">
                        <i class="nav-icon fas fa-cogs"></i>
                        <p>تنظیمات</p>
                    </a>
                </li>
            </ul>
        </nav>
    </div>
</aside>
