<select name="@Html.NameFor(m => m.ObjDetail.LINH_VUC_CHINH)" id="dllScope" onchange="ShowText2();"
    multiple="multiple" required title="Trường này bắt buộc nhập (required)">
@foreach (var item in serviceScopeType.ObjList.OrderBy(x => x.TEXT))
{
    var lstScope = serviceScope.ObjList.Where(x => x.TYPE_CODE == item.CODE).ToList();
    var lstScopeID = new List<string>();

    if (!string.IsNullOrEmpty(Model.ObjDetail.LINH_VUC_CHINH))
    {
        lstScopeID = Model.ObjDetail.LINH_VUC_CHINH.Split(',').ToList();
    }

    <optgroup label="@item.TEXT">
        @if (lstScopeID.Count > 0 && lstScopeID.Contains(item.CODE))
        {
            <option value="@item.CODE" selected>@item.TEXT</option>
        }
        else
        {
            <option value="@item.CODE">@item.TEXT</option>
        }
    </optgroup>
}
</select>