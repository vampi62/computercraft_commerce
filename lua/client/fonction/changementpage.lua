function changementpage(new_page)
	if new_page == -1 then
		global_page_visible = global_histo_nav[#global_histo_nav-1]["page"]
		global_scroll = global_histo_nav[#global_histo_nav-1]["scroll"]
		global_filtre = global_histo_nav[#global_histo_nav-1]["filtre"]
		table.remove(global_histo_nav,#global_histo_nav)
	else
		global_page_visible = new_page
		table.insert(global_histo_nav,{page=new_page,filtre={},scroll=global_scroll})
	end
	reinitbox()
end