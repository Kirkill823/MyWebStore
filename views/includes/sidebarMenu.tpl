<div class="flex-shrink-0 p-3 bg-white" style="width: 280px;">
    <a href="/" class="d-flex align-items-center pb-3 mb-3 link-dark text-decoration-none border-bottom">
        <svg class="bi pe-none me-2" width="30" height="24"><use xlink:href="#bootstrap"></use></svg>
        <span class="fs-5 fw-semibold">Категории</span>
    </a>
    <ul class="list-unstyled ps-0">
        {foreach $allCategories as $item}
            <li class="mb-1">
                <button class="btn btn-toggle d-inline-flex align-items-center rounded border-0 collapsed" data-bs-toggle="collapse" data-bs-target="#{$item['name_eng']}-collapse" aria-expanded="false">
                    {$item['name_ru']}
                </button>
                {if isset($item['children'])}
                    {if isset($recCategory)}
                        {if $recCategory['parent_id'] == $item['id']}
                            <div class ="collapse show" id="{$item['name_eng']}-collapse">
                            {else}
                            <div class ="collapse" id="{$item['name_eng']}-collapse">
                        {/if}
                    {else}
                    <div class="collapse" id="{$item['name_eng']}-collapse">
                    {/if}
                        <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
                            {foreach $item['children'] as $itemChild}
                               <li>
                                   <a href="/?controller=categories&id={$itemChild['id']}" class="link-dark d-inline-flex text-decoration-none rounded">{$itemChild['name_ru']}</a>
                               </li>
                            {/foreach}
                        </ul>
                    </div>
                {/if}
            </li>
        {/foreach}
    </ul>
</div>




