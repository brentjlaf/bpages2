<!-- views/bpages2/index.php: Template placeholder for missing template coverage. VDEMO -->
<style type="text/css">
.mwIndexTable .handler.sortable {
    display : none;
}
.mwIndexTable li.head .handler.nestable {
    display : none;
}
.mwIndexTable dl:hover>.handler.sortable {
    display : block;
}
.mwIndexTable dl:hover>.handler.nestable {
    display : none;
}
</style>

<ul id="mwDemoIndex" class="mwIndexTable">
  <li class="head">
    <dl>
      <dd class="handler nestable"></dd>
      <dd class="handler" data-sort="custom"></dd>
      <dt data-sort="title">Items <span class="hint">(12)</span></dt>
      <dd class="small">Status</dd>
    </dl>
  </li>
  <li class="group">
    <dl>
      <dd class="handler"></dd>
      <dt>Category A</dt>
    </dl>
  </li>
  <li data-id="item-basic" class="collapsed">
    <dl>
      <dd class="handler nestable collapsed"></dd>
      <dd class="handler sortable"></dd>
      <dt> <a href="#"> <span>Basic Item</span> </a> </dt>
      <dd><a class="button ok" href="#"></a></dd>
    </dl>
    <ul>
    </ul>
  </li>
  <li data-id="item-advanced" class="expanded">
    <dl>
      <dd class="handler nestable expanded"></dd>
      <dd class="handler sortable"></dd>
      <dt> <a href="#"> <span>Advanced Item</span> </a> </dt>
      <dd><a class="button ok" href="#"></a></dd>
    </dl>
    <ul>
      <li data-id="subitem-1" class="no-children collapsed">
        <dl>
          <dd class="handler nestable collapsed"></dd>
          <dd class="handler sortable"></dd>
          <dt> <a href="#"> <span>Sub-item 1</span> </a> </dt>
          <dd><a class="button delete" href="#"></a></dd>
        </dl>
      </li>
      <li data-id="subitem-2" class="no-children collapsed">
        <dl>
          <dd class="handler nestable collapsed"></dd>
          <dd class="handler sortable"></dd>
          <dt> <a href="#"> <span>Sub-item 2</span> </a> </dt>
          <dd><a class="button delete" href="#"></a></dd>
        </dl>
      </li>
    </ul>
  </li>
  <li class="group">
    <dl>
      <dd class="handler"></dd>
      <dt>Category B</dt>
    </dl>
  </li>
  <li data-id="collection-main" class="expanded">
    <dl>
      <dd class="handler nestable expanded"></dd>
      <dd class="handler sortable"></dd>
      <dt> <a href="#"> <span>Main Collection</span> </a> </dt>
      <dd><a class="button ok" href="#"></a></dd>
    </dl>
    <ul>
      <li data-id="element-alpha" class="no-children collapsed">
        <dl>
          <dd class="handler nestable collapsed"></dd>
          <dd class="handler sortable"></dd>
          <dt> <a href="#"> <span>Element Alpha</span> </a> </dt>
          <dd><a class="button ok" href="#"></a></dd>
        </dl>
      </li>
      <li data-id="element-beta" class="no-children collapsed">
        <dl>
          <dd class="handler nestable collapsed"></dd>
          <dd class="handler sortable"></dd>
          <dt> <a href="#"> <span>Element Beta</span> </a> </dt>
          <dd><a class="button ok" href="#"></a></dd>
        </dl>
      </li>
      <li data-id="element-gamma" class="no-children collapsed">
        <dl>
          <dd class="handler nestable collapsed"></dd>
          <dd class="handler sortable"></dd>
          <dt> <a href="#"> <span>Element Gamma</span> </a> </dt>
          <dd><a class="button ok" href="#"></a></dd>
        </dl>
      </li>
    </ul>
  </li>
  <li data-id="collection-archived" class="expanded">
    <dl>
      <dd class="handler nestable expanded"></dd>
      <dd class="handler sortable"></dd>
      <dt> <a href="#"> <span>Archived Collection</span> </a> </dt>
      <dd><a class="button ok" href="#"></a></dd>
    </dl>
    <ul>
      <li data-id="archive-old" class="no-children collapsed">
        <dl>
          <dd class="handler nestable collapsed"></dd>
          <dd class="handler sortable"></dd>
          <dt> <a href="#"> <span>Old Entry</span> </a> </dt>
          <dd><a class="button ok" href="#"></a></dd>
        </dl>
      </li>
      <li data-id="archive-legacy" class="no-children collapsed">
        <dl>
          <dd class="handler nestable collapsed"></dd>
          <dd class="handler sortable"></dd>
          <dt> <a href="#"> <span>Legacy Entry</span> </a> </dt>
          <dd><a class="button delete" href="#"></a></dd>
        </dl>
      </li>
    </ul>
  </li>
  <li class="group">
    <dl>
      <dd class="handler"></dd>
      <dt>Category C</dt>
    </dl>
  </li>
  <li data-id="dataset-primary" class="expanded">
    <dl>
      <dd class="handler nestable expanded"></dd>
      <dd class="handler sortable"></dd>
      <dt> <a href="#"> <span>Primary Dataset</span> </a> </dt>
      <dd><a class="button ok" href="#"></a></dd>
    </dl>
  </li>
  <li data-id="dataset-secondary" class="expanded">
    <dl>
      <dd class="handler nestable expanded"></dd>
      <dd class="handler sortable"></dd>
      <dt> <a href="#"> <span>Secondary Dataset</span> </a> </dt>
      <dd><a class="button ok" href="#"></a></dd>
    </dl>
  </li>
</ul>
