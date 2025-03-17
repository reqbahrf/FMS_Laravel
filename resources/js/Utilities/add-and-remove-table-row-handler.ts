function addNewRowHandler(ButtonSelector: string, ContainerSelectors: string) {
    $(ButtonSelector)
        .off('click')
        .on('click', function () {
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

function removeRowHandler(ButtonSelector: string, ContainerSelectors: string) {
    $(document)
        .off('click', ButtonSelector)
        .on('click', ButtonSelector, function () {
            console.log('Remove Row Button Clicked', {
                ButtonSelector,
                ContainerSelectors,
                thisElement: this,
            });
            const container = $(this).closest(ContainerSelectors);
            const tbody = container.find('tbody');
            const rows = tbody.find('tr');

            // Only remove if more than one row exists
            if (rows.length > 1) {
                tbody.find('tr:last-child').remove();
                toggleDeleteRowButton(container, 'tbody tr');
            } else {
                console.warn(
                    'Cannot remove the last remaining row in',
                    ContainerSelectors
                );
            }
        });
}

const toggleDeleteRowButton = (
    container: JQuery<Element>,
    elementSelector: string
) => {
    const element = container.find(elementSelector);
    const deleteRowButton = container.find('.removeRowButton');

    // Ensure the button exists before trying to disable it
    if (deleteRowButton.length > 0) {
        element.length === 1
            ? deleteRowButton.prop('disabled', true)
            : deleteRowButton.prop('disabled', false);
    }
};

export { addNewRowHandler, removeRowHandler };
