function AddNewRowHandler(ButtonSelector, ContainerSelectors) { 
    
    $(ButtonSelector).on('click', function() {
        const container = $(this).closest(ContainerSelectors);

        const table = container.find('table');
        const lastRow = table.find('tbody tr:last-child');
        const newRow = lastRow.clone();
        newRow.find('input, textarea').val('');
        newRow.find('select')?.prop('selectedIndex', 0);
        table.find('tbody').append(newRow);

        toggleDeleteRowButton(container, 'tbody tr');
    });


}

function RemoveRowHandler(ButtonSelector, ContainerSelectors) {

    $(ButtonSelector).on('click', function() {
        const container = $(this).closest(ContainerSelectors);
        container.find('tbody tr:last-child').remove();
        toggleDeleteRowButton(container, 'tbody tr');
    });

}

const toggleDeleteRowButton = (container, elementSelector) => {
    const element = container.find(elementSelector);
    const deleteRowButton = container.find('.removeRowButton');
    element.length === 1
        ? deleteRowButton.prop('disabled', true)
        : deleteRowButton.prop('disabled', false);
};

export { AddNewRowHandler, RemoveRowHandler };

