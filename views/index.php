<!-- views/index.php: Template placeholder for missing template coverage. VDEMO -->

<style type="text/css">

.mwIndexTable .handler.sortable {
	display	: none;
}

.mwIndexTable li.head .handler.nestable {
	display	: none;
}

.mwIndexTable dl:hover>.handler.sortable {
	display	: block;
}

.mwIndexTable dl:hover>.handler.nestable {
	display	: none;
}

.mwIndexTable .cell-custom-inline a {
	color			: blue;
}

</style>

<ul id="mwDemoIndex" class="mwIndexTable">

	<li class="head">
		<dl>

			<dd class="handler nestable"></dd>
			<dd class="handler" data-sort="custom"></dd>

			<dt data-sort="title">Items <span class="hint">(5)</span></dt>

			<dd class="small">Dynamic</dd>
			<dd class="small">Status</dd>

		</dl>
	</li>

	<li class="group">
		<dl>
			<dd class="handler"></dd>
			<dt>Sample Group</dt>
		</dl>
	</li>

	<li data-id="item-1" class="no-children collapsed">
		<dl>
			<dd class="handler nestable collapsed"></dd>
			<dd class="handler sortable"></dd>

			<dt>Simple Item</dt>

			<dd class="dyna" data-val="Foo">1</dd>

			<dd><a class="button ok" href="#"></a></dd>
		</dl>
	</li>

	<li data-id="item-2" class="expanded">
		<dl>
			<dd class="handler nestable expanded"></dd>
			<dd class="handler sortable"></dd>

			<dt>
				<a href="#">
					<span>Item with Children</span>
				</a>
			</dt>

			<dd class="dyna" data-val="Bar">2</dd>

			<dd><a class="button ok" href="#"></a></dd>
		</dl>

		<ul>

			<li data-id="subitem-1" class="no-children collapsed">
				<dl>
					<dd class="handler nestable collapsed"></dd>
					<dd class="handler sortable"></dd>

					<dt class="cell-custom-inline">
						<a href="#">
							<span>Sub-item 1</span>
						</a>
					</dt>

					<dd class="dyna" data-val="Qux">3</dd>

					<dd><a class="button delete" href="#"></a></dd>
				</dl>
			</li>

			<li data-id="subitem-2" class="no-children collapsed">
				<dl>
					<dd class="handler nestable collapsed"></dd>
					<dd class="handler sortable"></dd>

					<dt class="cell-custom-include">
						<a href="#">
							<span>Sub-item 2</span>
						</a>
					</dt>

					<dd class="dyna" data-val="Quux">4</dd>

					<dd><a class="button delete" href="#"></a></dd>
				</dl>
			</li>

		</ul>
	</li>

	<li data-id="item-3" class="no-children collapsed">
		<dl>
			<dd class="handler nestable collapsed"></dd>
			<dd class="handler sortable"></dd>

			<dt>
				<a href="#">
					<span>Another Item</span>
				</a>
			</dt>

			<dd class="dyna" data-val="Baz">5</dd>

			<dd><a class="button ok" href="#"></a></dd>

		</dl>
	</li>

</ul>

<script type="text/javascript">

	jQuery( function () {

		jQuery('.dyna').each( function () {
			myUpdateDyna( jQuery(this) );
		}); //jQuery.each(dyna)

	}); //jQuery

</script>









