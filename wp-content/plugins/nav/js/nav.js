// JavaScript Document
function viewProduct()
{
	with (window.document.frmListProduct) {
		if (cboCategory.selectedIndex == 0) {
			window.location.href = 'index.php';
		} else {
			window.location.href = 'index.php?cat_id=' + cat_id.options[cat_id.selectedIndex].value;
		}
	}
}

function ShowProduct(){
	window.location.href = 'index.php';
}
function checkProductForm()
{
	with (window.document.frmAddProduct) {
		if (cat_id.selectedIndex == 0) {
			alert('Choose the product category');
			cat_id.focus();
			return;
		}else if (isEmpty(product_name, 'Enter Product name')) {
			return;
		/*}else if (isEmpty(product_desc, 'Enter Description')) {
			return;*/
		}else if (isEmpty(product_mrp, 'Enter M.R.P')) {
			return;
		}else if (isEmpty(product_purchase_rate, 'Enter Purchase Rate')) {
			return;
		}else if (isEmpty(product_purchase_vat, 'Enter Purchase vat')) {
			return;
		}else if (isEmpty(product_sale_rate, 'Enter Sale Rate')) {
			return;
		}else{
			submit();
		}
	}
}

function checkAddCouponForm()
{
	with (window.document.frmAddProduct) {
		if (cboCategory.selectedIndex == 0) {
			alert('Choose the product category');
			cboCategory.focus();
			return;
		}else if (isEmpty(txtName, 'Enter Product name')) {
			return;
		/*}else if (isEmpty(mtxDescription, 'Enter product description')) {
			return;*/
		}else if (isEmpty(txtQty, 'Enter Quntity')) {
			return;
		}else if (isEmpty(discount, 'Enter Discount')) {
			return;
		}else{
			submit();
		}
	}
}

function addProduct(cat_id)
{
	var url = 'index.php?view=add';
	if(cat_id!=0){ url = url+'&cat_id=' +cat_id; } 
	window.location.href = url;
}

function modifyProduct(product_id, cat_id)
{
	window.location.href = 'index.php?view=modify&product_id=' + product_id+ '&cat_id=' + cat_id;
}

function deleteProduct(product_id)
{
	if (confirm('Delete this product?')) {
		window.location.href = 'processProduct.php?action=deleteProduct&product_id=' + product_id;
	}
}
