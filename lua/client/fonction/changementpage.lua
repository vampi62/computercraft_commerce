function changementpage(new_page)
	if new_page == -1 then
		reinitbox()
		global_page_visible = global_histo_nav[#global_histo_nav]["page"]
		global_scroll = global_histo_nav[#global_histo_nav]["scroll"]
		global_filtre = global_histo_nav[#global_histo_nav]["filtre"]
		global_variable = global_histo_nav[#global_histo_nav]["variable"]
		table.remove(global_histo_nav,#global_histo_nav)
	else
		table.insert(global_histo_nav,{page=global_page_visible,filtre=global_fitre,variable=global_variable,scroll=global_scroll})
		global_page_visible = new_page
		reinitbox()
	end
end