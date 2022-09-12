function changementpage(new_page)
	if new_page == -1 then
		global_page_visible = global_histo_nav[#global_histo_nav-1]
		table.remove(global_histo_nav,#global_histo_nav)
	else
		global_page_visible = new_page
		table.insert(global_histo_nav,new_page)
	end
	reinitbox()
end