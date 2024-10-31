@extends('admin.master')

@section('title', 'Lịch ')

@section('content')
    <div class="content-wrapper">

        <!-- Row start -->
        <div class="row">
            <div class="col-xxl-12">

                <!-- Card start -->
                <div class="card">
                    <div class="card-body">

                        <div id="dayGrid" class="fc fc-media-screen fc-direction-ltr fc-theme-standard">
                            <div class="fc-header-toolbar fc-toolbar fc-toolbar-ltr">
                                <div class="fc-toolbar-chunk">
                                    <div class="fc-button-group"><button
                                            class="fc-prevYear-button fc-button fc-button-primary" type="button"
                                            aria-label="prevYear"><span
                                                class="fc-icon fc-icon-chevrons-left"></span></button><button
                                            class="fc-prev-button fc-button fc-button-primary" type="button"
                                            aria-label="prev"><span
                                                class="fc-icon fc-icon-chevron-left"></span></button><button
                                            class="fc-next-button fc-button fc-button-primary" type="button"
                                            aria-label="next"><span
                                                class="fc-icon fc-icon-chevron-right"></span></button><button
                                            class="fc-nextYear-button fc-button fc-button-primary" type="button"
                                            aria-label="nextYear"><span
                                                class="fc-icon fc-icon-chevrons-right"></span></button></div><button
                                        class="fc-today-button fc-button fc-button-primary" type="button">today</button>
                                </div>
                                <div class="fc-toolbar-chunk">
                                    <h2 class="fc-toolbar-title">July 2021</h2>
                                </div>
                                <div class="fc-toolbar-chunk">
                                    <div class="fc-button-group"><button
                                            class="fc-dayGridMonth-button fc-button fc-button-primary fc-button-active"
                                            type="button">month</button><button
                                            class="fc-dayGridWeek-button fc-button fc-button-primary"
                                            type="button">week</button><button
                                            class="fc-dayGridDay-button fc-button fc-button-primary"
                                            type="button">day</button></div>
                                </div>
                            </div>
                            <div class="fc-view-harness fc-view-harness-active" style="height: 885.185px;">
                                <div class="fc-daygrid fc-dayGridMonth-view fc-view">
                                    <table class="fc-scrollgrid  fc-scrollgrid-liquid">
                                        <thead>
                                            <tr class="fc-scrollgrid-section fc-scrollgrid-section-header ">
                                                <td>
                                                    <div class="fc-scroller-harness">
                                                        <div class="fc-scroller" style="overflow: hidden;">
                                                            <table class="fc-col-header " style="width: 1193px;">
                                                                <colgroup></colgroup>
                                                                <tbody>
                                                                    <tr>
                                                                        <th class="fc-col-header-cell fc-day fc-day-sun">
                                                                            <div class="fc-scrollgrid-sync-inner"><a
                                                                                    class="fc-col-header-cell-cushion ">Sun</a>
                                                                            </div>
                                                                        </th>
                                                                        <th class="fc-col-header-cell fc-day fc-day-mon">
                                                                            <div class="fc-scrollgrid-sync-inner"><a
                                                                                    class="fc-col-header-cell-cushion ">Mon</a>
                                                                            </div>
                                                                        </th>
                                                                        <th class="fc-col-header-cell fc-day fc-day-tue">
                                                                            <div class="fc-scrollgrid-sync-inner"><a
                                                                                    class="fc-col-header-cell-cushion ">Tue</a>
                                                                            </div>
                                                                        </th>
                                                                        <th class="fc-col-header-cell fc-day fc-day-wed">
                                                                            <div class="fc-scrollgrid-sync-inner"><a
                                                                                    class="fc-col-header-cell-cushion ">Wed</a>
                                                                            </div>
                                                                        </th>
                                                                        <th class="fc-col-header-cell fc-day fc-day-thu">
                                                                            <div class="fc-scrollgrid-sync-inner"><a
                                                                                    class="fc-col-header-cell-cushion ">Thu</a>
                                                                            </div>
                                                                        </th>
                                                                        <th class="fc-col-header-cell fc-day fc-day-fri">
                                                                            <div class="fc-scrollgrid-sync-inner"><a
                                                                                    class="fc-col-header-cell-cushion ">Fri</a>
                                                                            </div>
                                                                        </th>
                                                                        <th class="fc-col-header-cell fc-day fc-day-sat">
                                                                            <div class="fc-scrollgrid-sync-inner"><a
                                                                                    class="fc-col-header-cell-cushion ">Sat</a>
                                                                            </div>
                                                                        </th>
                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr
                                                class="fc-scrollgrid-section fc-scrollgrid-section-body  fc-scrollgrid-section-liquid">
                                                <td>
                                                    <div class="fc-scroller-harness fc-scroller-harness-liquid">
                                                        <div class="fc-scroller fc-scroller-liquid-absolute"
                                                            style="overflow: hidden auto;">
                                                            <div class="fc-daygrid-body fc-daygrid-body-balanced "
                                                                style="width: 1193px;">
                                                                <table class="fc-scrollgrid-sync-table"
                                                                    style="width: 1193px; height: 851px;">
                                                                    <colgroup></colgroup>
                                                                    <tbody>
                                                                        <tr>
                                                                            <td class="fc-daygrid-day fc-day fc-day-sun fc-day-past fc-day-other"
                                                                                data-date="2021-06-27">
                                                                                <div
                                                                                    class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                    <div class="fc-daygrid-day-top"><a
                                                                                            class="fc-daygrid-day-number"
                                                                                            data-navlink="{&quot;date&quot;:&quot;2021-06-27&quot;,&quot;type&quot;:&quot;day&quot;}"
                                                                                            tabindex="0">27</a></div>
                                                                                    <div class="fc-daygrid-day-events">
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                </div>
                                                                            </td>
                                                                            <td class="fc-daygrid-day fc-day fc-day-mon fc-day-past fc-day-other"
                                                                                data-date="2021-06-28">
                                                                                <div
                                                                                    class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                    <div class="fc-daygrid-day-top"><a
                                                                                            class="fc-daygrid-day-number"
                                                                                            data-navlink="{&quot;date&quot;:&quot;2021-06-28&quot;,&quot;type&quot;:&quot;day&quot;}"
                                                                                            tabindex="0">28</a></div>
                                                                                    <div class="fc-daygrid-day-events">
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                </div>
                                                                            </td>
                                                                            <td class="fc-daygrid-day fc-day fc-day-tue fc-day-past fc-day-other"
                                                                                data-date="2021-06-29">
                                                                                <div
                                                                                    class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                    <div class="fc-daygrid-day-top"><a
                                                                                            class="fc-daygrid-day-number"
                                                                                            data-navlink="{&quot;date&quot;:&quot;2021-06-29&quot;,&quot;type&quot;:&quot;day&quot;}"
                                                                                            tabindex="0">29</a></div>
                                                                                    <div class="fc-daygrid-day-events">
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                </div>
                                                                            </td>
                                                                            <td class="fc-daygrid-day fc-day fc-day-wed fc-day-past fc-day-other"
                                                                                data-date="2021-06-30">
                                                                                <div
                                                                                    class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                    <div class="fc-daygrid-day-top"><a
                                                                                            class="fc-daygrid-day-number"
                                                                                            data-navlink="{&quot;date&quot;:&quot;2021-06-30&quot;,&quot;type&quot;:&quot;day&quot;}"
                                                                                            tabindex="0">30</a></div>
                                                                                    <div class="fc-daygrid-day-events">
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                </div>
                                                                            </td>
                                                                            <td class="fc-daygrid-day fc-day fc-day-thu fc-day-past"
                                                                                data-date="2021-07-01">
                                                                                <div
                                                                                    class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                    <div class="fc-daygrid-day-top"><a
                                                                                            class="fc-daygrid-day-number"
                                                                                            data-navlink="{&quot;date&quot;:&quot;2021-07-01&quot;,&quot;type&quot;:&quot;day&quot;}"
                                                                                            tabindex="0">1</a></div>
                                                                                    <div class="fc-daygrid-day-events">
                                                                                        <div
                                                                                            class="fc-daygrid-event-harness">
                                                                                            <a class="fc-daygrid-event fc-daygrid-block-event fc-h-event fc-event fc-event-draggable fc-event-resizable fc-event-start fc-event-end fc-event-past"
                                                                                                style="border-color: rgb(236, 190, 61); background-color: rgb(236, 190, 61);">
                                                                                                <div class="fc-event-main">
                                                                                                    <div
                                                                                                        class="fc-event-main-frame">
                                                                                                        <div
                                                                                                            class="fc-event-title-container">
                                                                                                            <div
                                                                                                                class="fc-event-title fc-sticky">
                                                                                                                All Day
                                                                                                                Event</div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div
                                                                                                    class="fc-event-resizer fc-event-resizer-end">
                                                                                                </div>
                                                                                            </a></div>
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                </div>
                                                                            </td>
                                                                            <td class="fc-daygrid-day fc-day fc-day-fri fc-day-past"
                                                                                data-date="2021-07-02">
                                                                                <div
                                                                                    class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                    <div class="fc-daygrid-day-top"><a
                                                                                            class="fc-daygrid-day-number"
                                                                                            data-navlink="{&quot;date&quot;:&quot;2021-07-02&quot;,&quot;type&quot;:&quot;day&quot;}"
                                                                                            tabindex="0">2</a></div>
                                                                                    <div class="fc-daygrid-day-events">
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                </div>
                                                                            </td>
                                                                            <td class="fc-daygrid-day fc-day fc-day-sat fc-day-past"
                                                                                data-date="2021-07-03">
                                                                                <div
                                                                                    class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                    <div class="fc-daygrid-day-top"><a
                                                                                            class="fc-daygrid-day-number"
                                                                                            data-navlink="{&quot;date&quot;:&quot;2021-07-03&quot;,&quot;type&quot;:&quot;day&quot;}"
                                                                                            tabindex="0">3</a></div>
                                                                                    <div class="fc-daygrid-day-events">
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="fc-daygrid-day fc-day fc-day-sun fc-day-past"
                                                                                data-date="2021-07-04">
                                                                                <div
                                                                                    class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                    <div class="fc-daygrid-day-top"><a
                                                                                            class="fc-daygrid-day-number"
                                                                                            data-navlink="{&quot;date&quot;:&quot;2021-07-04&quot;,&quot;type&quot;:&quot;day&quot;}"
                                                                                            tabindex="0">4</a></div>
                                                                                    <div class="fc-daygrid-day-events">
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                </div>
                                                                            </td>
                                                                            <td class="fc-daygrid-day fc-day fc-day-mon fc-day-past"
                                                                                data-date="2021-07-05">
                                                                                <div
                                                                                    class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                    <div class="fc-daygrid-day-top"><a
                                                                                            class="fc-daygrid-day-number"
                                                                                            data-navlink="{&quot;date&quot;:&quot;2021-07-05&quot;,&quot;type&quot;:&quot;day&quot;}"
                                                                                            tabindex="0">5</a></div>
                                                                                    <div class="fc-daygrid-day-events">
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                </div>
                                                                            </td>
                                                                            <td class="fc-daygrid-day fc-day fc-day-tue fc-day-past"
                                                                                data-date="2021-07-06">
                                                                                <div
                                                                                    class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                    <div class="fc-daygrid-day-top"><a
                                                                                            class="fc-daygrid-day-number"
                                                                                            data-navlink="{&quot;date&quot;:&quot;2021-07-06&quot;,&quot;type&quot;:&quot;day&quot;}"
                                                                                            tabindex="0">6</a></div>
                                                                                    <div class="fc-daygrid-day-events">
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                </div>
                                                                            </td>
                                                                            <td class="fc-daygrid-day fc-day fc-day-wed fc-day-past"
                                                                                data-date="2021-07-07">
                                                                                <div
                                                                                    class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                    <div class="fc-daygrid-day-top"><a
                                                                                            class="fc-daygrid-day-number"
                                                                                            data-navlink="{&quot;date&quot;:&quot;2021-07-07&quot;,&quot;type&quot;:&quot;day&quot;}"
                                                                                            tabindex="0">7</a></div>
                                                                                    <div class="fc-daygrid-day-events"
                                                                                        style="padding-bottom: 28.1px;">
                                                                                        <div class="fc-daygrid-event-harness fc-daygrid-event-harness-abs"
                                                                                            style="right: -340.85px;"><a
                                                                                                class="fc-daygrid-event fc-daygrid-block-event fc-h-event fc-event fc-event-draggable fc-event-resizable fc-event-start fc-event-end fc-event-past"
                                                                                                style="border-color: rgb(241, 124, 85); background-color: rgb(241, 124, 85);">
                                                                                                <div class="fc-event-main">
                                                                                                    <div
                                                                                                        class="fc-event-main-frame">
                                                                                                        <div
                                                                                                            class="fc-event-title-container">
                                                                                                            <div
                                                                                                                class="fc-event-title fc-sticky">
                                                                                                                Long Event
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div
                                                                                                    class="fc-event-resizer fc-event-resizer-end">
                                                                                                </div>
                                                                                            </a></div>
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                </div>
                                                                            </td>
                                                                            <td class="fc-daygrid-day fc-day fc-day-thu fc-day-past"
                                                                                data-date="2021-07-08">
                                                                                <div
                                                                                    class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                    <div class="fc-daygrid-day-top"><a
                                                                                            class="fc-daygrid-day-number"
                                                                                            data-navlink="{&quot;date&quot;:&quot;2021-07-08&quot;,&quot;type&quot;:&quot;day&quot;}"
                                                                                            tabindex="0">8</a></div>
                                                                                    <div class="fc-daygrid-day-events"
                                                                                        style="padding-bottom: 28.1px;">
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                </div>
                                                                            </td>
                                                                            <td class="fc-daygrid-day fc-day fc-day-fri fc-day-past"
                                                                                data-date="2021-07-09">
                                                                                <div
                                                                                    class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                    <div class="fc-daygrid-day-top"><a
                                                                                            class="fc-daygrid-day-number"
                                                                                            data-navlink="{&quot;date&quot;:&quot;2021-07-09&quot;,&quot;type&quot;:&quot;day&quot;}"
                                                                                            tabindex="0">9</a></div>
                                                                                    <div class="fc-daygrid-day-events">
                                                                                        <div class="fc-daygrid-event-harness"
                                                                                            style="margin-top: 28.1px;"><a
                                                                                                class="fc-daygrid-event fc-daygrid-dot-event fc-event fc-event-draggable fc-event-resizable fc-event-start fc-event-end fc-event-past">
                                                                                                <div class="fc-daygrid-event-dot"
                                                                                                    style="border-color: rgb(153, 166, 243);">
                                                                                                </div>
                                                                                                <div class="fc-event-time">
                                                                                                    4p</div>
                                                                                                <div
                                                                                                    class="fc-event-title">
                                                                                                    Birthday</div>
                                                                                            </a></div>
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                </div>
                                                                            </td>
                                                                            <td class="fc-daygrid-day fc-day fc-day-sat fc-day-past"
                                                                                data-date="2021-07-10">
                                                                                <div
                                                                                    class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                    <div class="fc-daygrid-day-top"><a
                                                                                            class="fc-daygrid-day-number"
                                                                                            data-navlink="{&quot;date&quot;:&quot;2021-07-10&quot;,&quot;type&quot;:&quot;day&quot;}"
                                                                                            tabindex="0">10</a></div>
                                                                                    <div class="fc-daygrid-day-events">
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="fc-daygrid-day fc-day fc-day-sun fc-day-past"
                                                                                data-date="2021-07-11">
                                                                                <div
                                                                                    class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                    <div class="fc-daygrid-day-top"><a
                                                                                            class="fc-daygrid-day-number"
                                                                                            data-navlink="{&quot;date&quot;:&quot;2021-07-11&quot;,&quot;type&quot;:&quot;day&quot;}"
                                                                                            tabindex="0">11</a></div>
                                                                                    <div class="fc-daygrid-day-events"
                                                                                        style="padding-bottom: 28.1px;">
                                                                                        <div class="fc-daygrid-event-harness fc-daygrid-event-harness-abs"
                                                                                            style="right: -170.425px;"><a
                                                                                                class="fc-daygrid-event fc-daygrid-block-event fc-h-event fc-event fc-event-draggable fc-event-resizable fc-event-start fc-event-end fc-event-past"
                                                                                                style="border-color: rgb(142, 202, 119); background-color: rgb(142, 202, 119);">
                                                                                                <div class="fc-event-main">
                                                                                                    <div
                                                                                                        class="fc-event-main-frame">
                                                                                                        <div
                                                                                                            class="fc-event-title-container">
                                                                                                            <div
                                                                                                                class="fc-event-title fc-sticky">
                                                                                                                Conference
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div
                                                                                                    class="fc-event-resizer fc-event-resizer-end">
                                                                                                </div>
                                                                                            </a></div>
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                </div>
                                                                            </td>
                                                                            <td class="fc-daygrid-day fc-day fc-day-mon fc-day-past"
                                                                                data-date="2021-07-12">
                                                                                <div
                                                                                    class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                    <div class="fc-daygrid-day-top"><a
                                                                                            class="fc-daygrid-day-number"
                                                                                            data-navlink="{&quot;date&quot;:&quot;2021-07-12&quot;,&quot;type&quot;:&quot;day&quot;}"
                                                                                            tabindex="0">12</a></div>
                                                                                    <div class="fc-daygrid-day-events"
                                                                                        style="padding-bottom: 28.1px;">
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                </div>
                                                                            </td>
                                                                            <td class="fc-daygrid-day fc-day fc-day-tue fc-day-past"
                                                                                data-date="2021-07-13">
                                                                                <div
                                                                                    class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                    <div class="fc-daygrid-day-top"><a
                                                                                            class="fc-daygrid-day-number"
                                                                                            data-navlink="{&quot;date&quot;:&quot;2021-07-13&quot;,&quot;type&quot;:&quot;day&quot;}"
                                                                                            tabindex="0">13</a></div>
                                                                                    <div class="fc-daygrid-day-events">
                                                                                        <div
                                                                                            class="fc-daygrid-event-harness">
                                                                                            <a
                                                                                                class="fc-daygrid-event fc-daygrid-dot-event fc-event fc-event-draggable fc-event-resizable fc-event-start fc-event-end fc-event-past">
                                                                                                <div class="fc-daygrid-event-dot"
                                                                                                    style="border-color: rgb(245, 103, 139);">
                                                                                                </div>
                                                                                                <div class="fc-event-time">
                                                                                                    7a</div>
                                                                                                <div
                                                                                                    class="fc-event-title">
                                                                                                    Birthday</div>
                                                                                            </a></div>
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                </div>
                                                                            </td>
                                                                            <td class="fc-daygrid-day fc-day fc-day-wed fc-day-past"
                                                                                data-date="2021-07-14">
                                                                                <div
                                                                                    class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                    <div class="fc-daygrid-day-top"><a
                                                                                            class="fc-daygrid-day-number"
                                                                                            data-navlink="{&quot;date&quot;:&quot;2021-07-14&quot;,&quot;type&quot;:&quot;day&quot;}"
                                                                                            tabindex="0">14</a></div>
                                                                                    <div class="fc-daygrid-day-events">
                                                                                        <div
                                                                                            class="fc-daygrid-event-harness">
                                                                                            <a
                                                                                                class="fc-daygrid-event fc-daygrid-dot-event fc-event fc-event-draggable fc-event-resizable fc-event-start fc-event-end fc-event-past">
                                                                                                <div
                                                                                                    class="fc-daygrid-event-dot">
                                                                                                </div>
                                                                                                <div class="fc-event-time">
                                                                                                    10:30a</div>
                                                                                                <div
                                                                                                    class="fc-event-title">
                                                                                                    Meeting</div>
                                                                                            </a></div>
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                </div>
                                                                            </td>
                                                                            <td class="fc-daygrid-day fc-day fc-day-thu fc-day-past"
                                                                                data-date="2021-07-15">
                                                                                <div
                                                                                    class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                    <div class="fc-daygrid-day-top"><a
                                                                                            class="fc-daygrid-day-number"
                                                                                            data-navlink="{&quot;date&quot;:&quot;2021-07-15&quot;,&quot;type&quot;:&quot;day&quot;}"
                                                                                            tabindex="0">15</a></div>
                                                                                    <div class="fc-daygrid-day-events">
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                </div>
                                                                            </td>
                                                                            <td class="fc-daygrid-day fc-day fc-day-fri fc-day-past"
                                                                                data-date="2021-07-16">
                                                                                <div
                                                                                    class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                    <div class="fc-daygrid-day-top"><a
                                                                                            class="fc-daygrid-day-number"
                                                                                            data-navlink="{&quot;date&quot;:&quot;2021-07-16&quot;,&quot;type&quot;:&quot;day&quot;}"
                                                                                            tabindex="0">16</a></div>
                                                                                    <div class="fc-daygrid-day-events">
                                                                                        <div
                                                                                            class="fc-daygrid-event-harness">
                                                                                            <a
                                                                                                class="fc-daygrid-event fc-daygrid-dot-event fc-event fc-event-draggable fc-event-resizable fc-event-start fc-event-end fc-event-past">
                                                                                                <div class="fc-daygrid-event-dot"
                                                                                                    style="border-color: rgb(241, 164, 54);">
                                                                                                </div>
                                                                                                <div class="fc-event-time">
                                                                                                    12p</div>
                                                                                                <div
                                                                                                    class="fc-event-title">
                                                                                                    Lunch</div>
                                                                                            </a></div>
                                                                                        <div
                                                                                            class="fc-daygrid-event-harness">
                                                                                            <a
                                                                                                class="fc-daygrid-event fc-daygrid-dot-event fc-event fc-event-draggable fc-event-resizable fc-event-start fc-event-end fc-event-past">
                                                                                                <div class="fc-daygrid-event-dot"
                                                                                                    style="border-color: rgb(236, 79, 61);">
                                                                                                </div>
                                                                                                <div class="fc-event-time">
                                                                                                    4p</div>
                                                                                                <div
                                                                                                    class="fc-event-title">
                                                                                                    Birthday</div>
                                                                                            </a></div>
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                </div>
                                                                            </td>
                                                                            <td class="fc-daygrid-day fc-day fc-day-sat fc-day-past"
                                                                                data-date="2021-07-17">
                                                                                <div
                                                                                    class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                    <div class="fc-daygrid-day-top"><a
                                                                                            class="fc-daygrid-day-number"
                                                                                            data-navlink="{&quot;date&quot;:&quot;2021-07-17&quot;,&quot;type&quot;:&quot;day&quot;}"
                                                                                            tabindex="0">17</a></div>
                                                                                    <div class="fc-daygrid-day-events">
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="fc-daygrid-day fc-day fc-day-sun fc-day-past"
                                                                                data-date="2021-07-18">
                                                                                <div
                                                                                    class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                    <div class="fc-daygrid-day-top"><a
                                                                                            class="fc-daygrid-day-number"
                                                                                            data-navlink="{&quot;date&quot;:&quot;2021-07-18&quot;,&quot;type&quot;:&quot;day&quot;}"
                                                                                            tabindex="0">18</a></div>
                                                                                    <div class="fc-daygrid-day-events">
                                                                                        <div
                                                                                            class="fc-daygrid-event-harness">
                                                                                            <a
                                                                                                class="fc-daygrid-event fc-daygrid-dot-event fc-event fc-event-draggable fc-event-resizable fc-event-start fc-event-end fc-event-past">
                                                                                                <div class="fc-daygrid-event-dot"
                                                                                                    style="border-color: rgb(52, 194, 208);">
                                                                                                </div>
                                                                                                <div class="fc-event-time">
                                                                                                    2:30p</div>
                                                                                                <div
                                                                                                    class="fc-event-title">
                                                                                                    Meeting</div>
                                                                                            </a></div>
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                </div>
                                                                            </td>
                                                                            <td class="fc-daygrid-day fc-day fc-day-mon fc-day-past"
                                                                                data-date="2021-07-19">
                                                                                <div
                                                                                    class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                    <div class="fc-daygrid-day-top"><a
                                                                                            class="fc-daygrid-day-number"
                                                                                            data-navlink="{&quot;date&quot;:&quot;2021-07-19&quot;,&quot;type&quot;:&quot;day&quot;}"
                                                                                            tabindex="0">19</a></div>
                                                                                    <div class="fc-daygrid-day-events">
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                </div>
                                                                            </td>
                                                                            <td class="fc-daygrid-day fc-day fc-day-tue fc-day-past"
                                                                                data-date="2021-07-20">
                                                                                <div
                                                                                    class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                    <div class="fc-daygrid-day-top"><a
                                                                                            class="fc-daygrid-day-number"
                                                                                            data-navlink="{&quot;date&quot;:&quot;2021-07-20&quot;,&quot;type&quot;:&quot;day&quot;}"
                                                                                            tabindex="0">20</a></div>
                                                                                    <div class="fc-daygrid-day-events">
                                                                                        <div
                                                                                            class="fc-daygrid-event-harness">
                                                                                            <a class="fc-daygrid-event fc-daygrid-block-event fc-h-event fc-event fc-event-draggable fc-event-resizable fc-event-start fc-event-end fc-event-past"
                                                                                                style="border-color: rgb(167, 112, 181); background-color: rgb(167, 112, 181);">
                                                                                                <div class="fc-event-main">
                                                                                                    <div
                                                                                                        class="fc-event-main-frame">
                                                                                                        <div
                                                                                                            class="fc-event-title-container">
                                                                                                            <div
                                                                                                                class="fc-event-title fc-sticky">
                                                                                                                Interview
                                                                                                            </div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div
                                                                                                    class="fc-event-resizer fc-event-resizer-end">
                                                                                                </div>
                                                                                            </a></div>
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                </div>
                                                                            </td>
                                                                            <td class="fc-daygrid-day fc-day fc-day-wed fc-day-past"
                                                                                data-date="2021-07-21">
                                                                                <div
                                                                                    class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                    <div class="fc-daygrid-day-top"><a
                                                                                            class="fc-daygrid-day-number"
                                                                                            data-navlink="{&quot;date&quot;:&quot;2021-07-21&quot;,&quot;type&quot;:&quot;day&quot;}"
                                                                                            tabindex="0">21</a></div>
                                                                                    <div class="fc-daygrid-day-events">
                                                                                        <div
                                                                                            class="fc-daygrid-event-harness">
                                                                                            <a
                                                                                                class="fc-daygrid-event fc-daygrid-dot-event fc-event fc-event-draggable fc-event-resizable fc-event-start fc-event-end fc-event-past">
                                                                                                <div class="fc-daygrid-event-dot"
                                                                                                    style="border-color: rgb(178, 213, 83);">
                                                                                                </div>
                                                                                                <div class="fc-event-time">
                                                                                                    5:30p</div>
                                                                                                <div
                                                                                                    class="fc-event-title">
                                                                                                    Interview</div>
                                                                                            </a></div>
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                </div>
                                                                            </td>
                                                                            <td class="fc-daygrid-day fc-day fc-day-thu fc-day-past"
                                                                                data-date="2021-07-22">
                                                                                <div
                                                                                    class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                    <div class="fc-daygrid-day-top"><a
                                                                                            class="fc-daygrid-day-number"
                                                                                            data-navlink="{&quot;date&quot;:&quot;2021-07-22&quot;,&quot;type&quot;:&quot;day&quot;}"
                                                                                            tabindex="0">22</a></div>
                                                                                    <div class="fc-daygrid-day-events">
                                                                                        <div
                                                                                            class="fc-daygrid-event-harness">
                                                                                            <a
                                                                                                class="fc-daygrid-event fc-daygrid-dot-event fc-event fc-event-draggable fc-event-resizable fc-event-start fc-event-end fc-event-past">
                                                                                                <div class="fc-daygrid-event-dot"
                                                                                                    style="border-color: rgb(64, 206, 166);">
                                                                                                </div>
                                                                                                <div class="fc-event-time">
                                                                                                    8p</div>
                                                                                                <div
                                                                                                    class="fc-event-title">
                                                                                                    Meeting</div>
                                                                                            </a></div>
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                </div>
                                                                            </td>
                                                                            <td class="fc-daygrid-day fc-day fc-day-fri fc-day-past"
                                                                                data-date="2021-07-23">
                                                                                <div
                                                                                    class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                    <div class="fc-daygrid-day-top"><a
                                                                                            class="fc-daygrid-day-number"
                                                                                            data-navlink="{&quot;date&quot;:&quot;2021-07-23&quot;,&quot;type&quot;:&quot;day&quot;}"
                                                                                            tabindex="0">23</a></div>
                                                                                    <div class="fc-daygrid-day-events">
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                </div>
                                                                            </td>
                                                                            <td class="fc-daygrid-day fc-day fc-day-sat fc-day-past"
                                                                                data-date="2021-07-24">
                                                                                <div
                                                                                    class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                    <div class="fc-daygrid-day-top"><a
                                                                                            class="fc-daygrid-day-number"
                                                                                            data-navlink="{&quot;date&quot;:&quot;2021-07-24&quot;,&quot;type&quot;:&quot;day&quot;}"
                                                                                            tabindex="0">24</a></div>
                                                                                    <div class="fc-daygrid-day-events">
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="fc-daygrid-day fc-day fc-day-sun fc-day-past"
                                                                                data-date="2021-07-25">
                                                                                <div
                                                                                    class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                    <div class="fc-daygrid-day-top"><a
                                                                                            class="fc-daygrid-day-number"
                                                                                            data-navlink="{&quot;date&quot;:&quot;2021-07-25&quot;,&quot;type&quot;:&quot;day&quot;}"
                                                                                            tabindex="0">25</a></div>
                                                                                    <div class="fc-daygrid-day-events">
                                                                                        <div
                                                                                            class="fc-daygrid-event-harness">
                                                                                            <a class="fc-daygrid-event fc-daygrid-block-event fc-h-event fc-event fc-event-draggable fc-event-resizable fc-event-start fc-event-end fc-event-past"
                                                                                                style="border-color: rgb(53, 179, 192); background-color: rgb(53, 179, 192);">
                                                                                                <div class="fc-event-main">
                                                                                                    <div
                                                                                                        class="fc-event-main-frame">
                                                                                                        <div
                                                                                                            class="fc-event-title-container">
                                                                                                            <div
                                                                                                                class="fc-event-title fc-sticky">
                                                                                                                Leave</div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div
                                                                                                    class="fc-event-resizer fc-event-resizer-end">
                                                                                                </div>
                                                                                            </a></div>
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                </div>
                                                                            </td>
                                                                            <td class="fc-daygrid-day fc-day fc-day-mon fc-day-past"
                                                                                data-date="2021-07-26">
                                                                                <div
                                                                                    class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                    <div class="fc-daygrid-day-top"><a
                                                                                            class="fc-daygrid-day-number"
                                                                                            data-navlink="{&quot;date&quot;:&quot;2021-07-26&quot;,&quot;type&quot;:&quot;day&quot;}"
                                                                                            tabindex="0">26</a></div>
                                                                                    <div class="fc-daygrid-day-events">
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                </div>
                                                                            </td>
                                                                            <td class="fc-daygrid-day fc-day fc-day-tue fc-day-past"
                                                                                data-date="2021-07-27">
                                                                                <div
                                                                                    class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                    <div class="fc-daygrid-day-top"><a
                                                                                            class="fc-daygrid-day-number"
                                                                                            data-navlink="{&quot;date&quot;:&quot;2021-07-27&quot;,&quot;type&quot;:&quot;day&quot;}"
                                                                                            tabindex="0">27</a></div>
                                                                                    <div class="fc-daygrid-day-events">
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                </div>
                                                                            </td>
                                                                            <td class="fc-daygrid-day fc-day fc-day-wed fc-day-past"
                                                                                data-date="2021-07-28">
                                                                                <div
                                                                                    class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                    <div class="fc-daygrid-day-top"><a
                                                                                            class="fc-daygrid-day-number"
                                                                                            data-navlink="{&quot;date&quot;:&quot;2021-07-28&quot;,&quot;type&quot;:&quot;day&quot;}"
                                                                                            tabindex="0">28</a></div>
                                                                                    <div class="fc-daygrid-day-events">
                                                                                        <div
                                                                                            class="fc-daygrid-event-harness">
                                                                                            <a class="fc-daygrid-event fc-daygrid-block-event fc-h-event fc-event fc-event-draggable fc-event-resizable fc-event-start fc-event-end fc-event-past"
                                                                                                href="http://google.com/"
                                                                                                style="border-color: rgb(152, 196, 82); background-color: rgb(152, 196, 82);">
                                                                                                <div class="fc-event-main">
                                                                                                    <div
                                                                                                        class="fc-event-main-frame">
                                                                                                        <div
                                                                                                            class="fc-event-title-container">
                                                                                                            <div
                                                                                                                class="fc-event-title fc-sticky">
                                                                                                                Click for
                                                                                                                Google</div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div
                                                                                                    class="fc-event-resizer fc-event-resizer-end">
                                                                                                </div>
                                                                                            </a></div>
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                </div>
                                                                            </td>
                                                                            <td class="fc-daygrid-day fc-day fc-day-thu fc-day-past"
                                                                                data-date="2021-07-29">
                                                                                <div
                                                                                    class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                    <div class="fc-daygrid-day-top"><a
                                                                                            class="fc-daygrid-day-number"
                                                                                            data-navlink="{&quot;date&quot;:&quot;2021-07-29&quot;,&quot;type&quot;:&quot;day&quot;}"
                                                                                            tabindex="0">29</a></div>
                                                                                    <div class="fc-daygrid-day-events">
                                                                                        <div
                                                                                            class="fc-daygrid-event-harness">
                                                                                            <a class="fc-daygrid-event fc-daygrid-block-event fc-h-event fc-event fc-event-draggable fc-event-resizable fc-event-start fc-event-end fc-event-past"
                                                                                                style="border-color: rgb(241, 164, 54); background-color: rgb(241, 164, 54);">
                                                                                                <div class="fc-event-main">
                                                                                                    <div
                                                                                                        class="fc-event-main-frame">
                                                                                                        <div
                                                                                                            class="fc-event-title-container">
                                                                                                            <div
                                                                                                                class="fc-event-title fc-sticky">
                                                                                                                Product
                                                                                                                Launch</div>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </div>
                                                                                                <div
                                                                                                    class="fc-event-resizer fc-event-resizer-end">
                                                                                                </div>
                                                                                            </a></div>
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                </div>
                                                                            </td>
                                                                            <td class="fc-daygrid-day fc-day fc-day-fri fc-day-past"
                                                                                data-date="2021-07-30">
                                                                                <div
                                                                                    class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                    <div class="fc-daygrid-day-top"><a
                                                                                            class="fc-daygrid-day-number"
                                                                                            data-navlink="{&quot;date&quot;:&quot;2021-07-30&quot;,&quot;type&quot;:&quot;day&quot;}"
                                                                                            tabindex="0">30</a></div>
                                                                                    <div class="fc-daygrid-day-events">
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                </div>
                                                                            </td>
                                                                            <td class="fc-daygrid-day fc-day fc-day-sat fc-day-past"
                                                                                data-date="2021-07-31">
                                                                                <div
                                                                                    class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                    <div class="fc-daygrid-day-top"><a
                                                                                            class="fc-daygrid-day-number"
                                                                                            data-navlink="{&quot;date&quot;:&quot;2021-07-31&quot;,&quot;type&quot;:&quot;day&quot;}"
                                                                                            tabindex="0">31</a></div>
                                                                                    <div class="fc-daygrid-day-events">
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td class="fc-daygrid-day fc-day fc-day-sun fc-day-past fc-day-other"
                                                                                data-date="2021-08-01">
                                                                                <div
                                                                                    class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                    <div class="fc-daygrid-day-top"><a
                                                                                            class="fc-daygrid-day-number"
                                                                                            data-navlink="{&quot;date&quot;:&quot;2021-08-01&quot;,&quot;type&quot;:&quot;day&quot;}"
                                                                                            tabindex="0">1</a></div>
                                                                                    <div class="fc-daygrid-day-events">
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                </div>
                                                                            </td>
                                                                            <td class="fc-daygrid-day fc-day fc-day-mon fc-day-past fc-day-other"
                                                                                data-date="2021-08-02">
                                                                                <div
                                                                                    class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                    <div class="fc-daygrid-day-top"><a
                                                                                            class="fc-daygrid-day-number"
                                                                                            data-navlink="{&quot;date&quot;:&quot;2021-08-02&quot;,&quot;type&quot;:&quot;day&quot;}"
                                                                                            tabindex="0">2</a></div>
                                                                                    <div class="fc-daygrid-day-events">
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                </div>
                                                                            </td>
                                                                            <td class="fc-daygrid-day fc-day fc-day-tue fc-day-past fc-day-other"
                                                                                data-date="2021-08-03">
                                                                                <div
                                                                                    class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                    <div class="fc-daygrid-day-top"><a
                                                                                            class="fc-daygrid-day-number"
                                                                                            data-navlink="{&quot;date&quot;:&quot;2021-08-03&quot;,&quot;type&quot;:&quot;day&quot;}"
                                                                                            tabindex="0">3</a></div>
                                                                                    <div class="fc-daygrid-day-events">
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                </div>
                                                                            </td>
                                                                            <td class="fc-daygrid-day fc-day fc-day-wed fc-day-past fc-day-other"
                                                                                data-date="2021-08-04">
                                                                                <div
                                                                                    class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                    <div class="fc-daygrid-day-top"><a
                                                                                            class="fc-daygrid-day-number"
                                                                                            data-navlink="{&quot;date&quot;:&quot;2021-08-04&quot;,&quot;type&quot;:&quot;day&quot;}"
                                                                                            tabindex="0">4</a></div>
                                                                                    <div class="fc-daygrid-day-events">
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                </div>
                                                                            </td>
                                                                            <td class="fc-daygrid-day fc-day fc-day-thu fc-day-past fc-day-other"
                                                                                data-date="2021-08-05">
                                                                                <div
                                                                                    class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                    <div class="fc-daygrid-day-top"><a
                                                                                            class="fc-daygrid-day-number"
                                                                                            data-navlink="{&quot;date&quot;:&quot;2021-08-05&quot;,&quot;type&quot;:&quot;day&quot;}"
                                                                                            tabindex="0">5</a></div>
                                                                                    <div class="fc-daygrid-day-events">
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                </div>
                                                                            </td>
                                                                            <td class="fc-daygrid-day fc-day fc-day-fri fc-day-past fc-day-other"
                                                                                data-date="2021-08-06">
                                                                                <div
                                                                                    class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                    <div class="fc-daygrid-day-top"><a
                                                                                            class="fc-daygrid-day-number"
                                                                                            data-navlink="{&quot;date&quot;:&quot;2021-08-06&quot;,&quot;type&quot;:&quot;day&quot;}"
                                                                                            tabindex="0">6</a></div>
                                                                                    <div class="fc-daygrid-day-events">
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                </div>
                                                                            </td>
                                                                            <td class="fc-daygrid-day fc-day fc-day-sat fc-day-past fc-day-other"
                                                                                data-date="2021-08-07">
                                                                                <div
                                                                                    class="fc-daygrid-day-frame fc-scrollgrid-sync-inner">
                                                                                    <div class="fc-daygrid-day-top"><a
                                                                                            class="fc-daygrid-day-number"
                                                                                            data-navlink="{&quot;date&quot;:&quot;2021-08-07&quot;,&quot;type&quot;:&quot;day&quot;}"
                                                                                            tabindex="0">7</a></div>
                                                                                    <div class="fc-daygrid-day-events">
                                                                                    </div>
                                                                                    <div class="fc-daygrid-day-bg"></div>
                                                                                </div>
                                                                            </td>
                                                                        </tr>
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
                <!-- Card end -->

            </div>
        </div>
        <!-- Row end -->

    </div>
@endsection
