import { describe, it, expect, beforeEach } from 'vitest'
import TableDataExtractor from './TableDataExtractor'
import $ from 'jquery'

// Mock DOM setup
document.body.innerHTML = `
  <table id="testTable">
    <tbody>
      <tr>
        <td><input class="product" value="Apple" /></td>
        <td><input class="location" value="Market 1" /></td>
        <td><input class="volume" value="100" /></td>
        <td><input class="unit" value="kg" /></td>
      </tr>
      <tr>
        <td><input class="product" value="" /></td>
        <td><input class="location" value="Market 2" /></td>
        <td><input class="volume" value="50" /></td>
        <td><input class="unit" value="kg" /></td>
      </tr>
    </tbody>
  </table>
`

describe('TableDataExtractor', () => {
  const tableConfig = {
    id: 'testTable',
    selectors: {
      product: '.product',
      location: '.location',
      volume: '.volume',
      unit: '.unit'
    },
    requiredFields: ['product']
  }

  it('should extract data only from rows with required fields', () => {
    const result = TableDataExtractor(
      tableConfig.id,
      tableConfig.selectors,
      tableConfig.requiredFields
    )

    expect(result).toHaveLength(1)
    expect(result[0]).toEqual({
      product: 'Apple',
      location: 'Market 1',
      volume: '100',
      unit: 'kg'
    })
  })

  it('should skip rows with missing required fields', () => {
    const result = TableDataExtractor(
      tableConfig.id,
      tableConfig.selectors,
      tableConfig.requiredFields
    )

    const emptyProducts = result.filter(row => !row.product)
    expect(emptyProducts).toHaveLength(0)
  })
})
