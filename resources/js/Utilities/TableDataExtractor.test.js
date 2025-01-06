import { TableDataExtractor } from './TableDataExtractor';
describe('TableDataExtractor', () => {
    // Process multiple tables with valid configurations and return combined data
    it('should process multiple tables and return combined data when valid configurations provided', () => {
        document.body.innerHTML = `
        <table id="table1">
          <tbody>
            <tr><td><input class="name" value="John"/></td></tr>
          </tbody>
        </table>
        <table id="table2">
          <tbody>
            <tr><td><input class="age" value="25"/></td></tr>
          </tbody>
        </table>
      `;

        const configs = {
            table1: {
                id: 'table1',
                selectors: { name: '.name' },
                requiredFields: ['name'],
            },
            table2: {
                id: 'table2',
                selectors: { age: '.age' },
                requiredFields: ['age'],
            },
        };

        const result = TableDataExtractor(configs);

        expect(result).toEqual({
            table1: [{ name: 'John' }],
            table2: [{ age: '25' }],
        });
    });

    // Extract data from table rows using simple string selectors
    it('should extract data using simple string selectors when table has multiple rows', () => {
        document.body.innerHTML = `
        <table id="test-table">
          <tbody>
            <tr>
              <td><input class="name" value="John"/></td>
              <td><input class="email" value="john@test.com"/></td>
            </tr>
            <tr>
              <td><input class="name" value="Jane"/></td>
              <td><input class="email" value="jane@test.com"/></td>
            </tr>
          </tbody>
        </table>
      `;

        const configs = {
            users: {
                id: 'test-table',
                selectors: {
                    name: '.name',
                    email: '.email',
                },
                requiredFields: ['name', 'email'],
            },
        };

        const result = TableDataExtractor(configs);

        expect(result.users).toEqual([
            { name: 'John', email: 'john@test.com' },
            { name: 'Jane', email: 'jane@test.com' },
        ]);
    });

    // Handle empty table configurations object
    it('should return empty object when configurations object is empty', () => {
        const emptyConfigs = {};

        const result = TableDataExtractor(emptyConfigs);

        expect(result).toEqual({});
    });

    // Process table with no rows
    it('should return empty array for table key when table has no rows', () => {
        document.body.innerHTML = `
        <table id="empty-table">
          <tbody></tbody>
        </table>
      `;

        const configs = {
            emptyTable: {
                id: 'empty-table',
                selectors: { name: '.name' },
                requiredFields: ['name'],
            },
        };

        const result = TableDataExtractor(configs);

        expect(result.emptyTable).toEqual([]);
    });
    
    // Extract data from deeply nested elements
    it('should extract data from deeply nested elements', () => {
        document.body.innerHTML = `
          <table id="nested-table">
            <tbody>
              <tr>
                <td>
                  <div class="group">
                    <input class="item" value="Nested Value" />
                    <div class="subgroup">
                        <input class="subitem" value="Deep Value" />
                    </div>
                  </div>
                </td>
              </tr>
            </tbody>
          </table>
        `;
    
        const configs = {
          nested: {
            id: 'nested-table',
            selectors: {
              group: {
                item: '.item',
                subgroup: {
                    subitem: '.subitem'
                }
              }
            },
            requiredFields: ['group.item', 'group.subgroup.subitem'],
          },
        };
    
        const result = TableDataExtractor(configs);
    
        expect(result.nested).toEqual([
          {
            group: {
              item: 'Nested Value',
              subgroup: {
                subitem: 'Deep Value',
              },
            },
          },
        ]);
      });
});