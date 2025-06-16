<script setup lang="ts" generic="TData">
import { ref, watch } from 'vue';
import {
    FlexRender,
    getCoreRowModel,
    getPaginationRowModel, // Sayfalama için
    useVueTable,
    type ColumnDef,
    type SortingState, // Sıralama için
    type ColumnFiltersState, // Filtreleme için
    getFilteredRowModel, // Filtreleme için
    getSortedRowModel, // Sıralama için
} from '@tanstack/vue-table';

import { Table, TableBody, TableCell, TableHead, TableHeader, TableRow } from '@/components/ui/table';
import { Button } from '@/components/ui/button';
import { Input } from '@/components/ui/input'; // Filtreleme için

// Props tanımı
interface DataTableProps<T> {
    columns: ColumnDef<T>[];
    data: T[];
    // Filtreleme için
    filterableColumnId?: keyof T; // Filtreleme yapılacak sütun ID'si
}

const props = defineProps<DataTableProps<TData>>();

// Reactive state for table
const sorting = ref<SortingState>([]);
const columnFilters = ref<ColumnFiltersState>([]);

// Filtre inputu için yerel ref
const filterValue = ref('');

const table = useVueTable({
    data: props.data,
    columns: props.columns,
    getCoreRowModel: getCoreRowModel(),
    getPaginationRowModel: getPaginationRowModel(),
    getSortedRowModel: getSortedRowModel(),
    getFilteredRowModel: getFilteredRowModel(),
    onSortingChange: updater => sorting.value = typeof updater === 'function' ? updater(sorting.value) : updater,
    onColumnFiltersChange: updater => columnFilters.value = typeof updater === 'function' ? updater(columnFilters.value) : updater,
    state: {
        get sorting() { return sorting.value; },
        get columnFilters() { return columnFilters.value; },
    },
});

// filterValue'yu başlat ve tablonun filtresi değiştiğinde güncelle
watch(() => {
    if (props.filterableColumnId) {
        const column = table.getColumn(props.filterableColumnId as string);
        if (column) {
            // getFilterValue() doğrudan bir Ref veya benzeri bir değer döndürdüğü için .value'ya erişebiliriz
            // Ancak getFilterValue().value, null/undefined olabileceği için kontrol etmek iyi olur
            const currentFilter = column.getFilterValue();
            filterValue.value = currentFilter !== undefined && currentFilter !== null ? String(currentFilter) : '';
        }
    }
}, { immediate: true, deep: true }); // Bileşen yüklendiğinde ve derinlemesine değişikliklerde çalıştır

// filterValue değiştiğinde tablonun filtresini güncelle
watch(filterValue, (newValue) => {
    if (props.filterableColumnId) {
        const column = table.getColumn(props.filterableColumnId as string);
        if (column) {
            column.setFilterValue(newValue);
        }
    }
});
</script>

<template>
    <div>
        <div v-if="props.filterableColumnId" class="flex items-center py-4">
            <!--
            <Input :placeholder="`Filter ${String(props.filterableColumnId)}...`" class="max-w-sm"
                v-model="table.getColumn(props.filterableColumnId as string).getFilterValue().value" />
            -->
        </div>

        <div class="rounded-md border">
            <Table>
                <TableHeader>
                    <TableRow v-for="headerGroup in table.getHeaderGroups()" :key="headerGroup.id">
                        <TableHead v-for="header in headerGroup.headers" :key="header.id">
                            <FlexRender v-if="!header.isPlaceholder" :render="header.column.columnDef.header"
                                :props="header.getContext()" />
                        </TableHead>
                    </TableRow>
                </TableHeader>
                <TableBody>
                    <template v-if="table.getRowModel().rows?.length">
                        <TableRow v-for="row in table.getRowModel().rows" :key="row.id"
                            :data-state="row.getIsSelected() && 'selected'">
                            <TableCell v-for="cell in row.getVisibleCells()" :key="cell.id">
                                <FlexRender :render="cell.column.columnDef.cell" :props="cell.getContext()" />
                            </TableCell>
                        </TableRow>
                    </template>
                    <template v-else>
                        <TableRow>
                            <TableCell :colspan="props.columns.length" class="h-24 text-center">
                                No results.
                            </TableCell>
                        </TableRow>
                    </template>
                </TableBody>
            </Table>
        </div>

        <div class="flex items-center justify-end space-x-2 py-4">
            <Button variant="outline" size="sm" :disabled="!table.getCanPreviousPage()" @click="table.previousPage()">
                Previous
            </Button>
            <Button variant="outline" size="sm" :disabled="!table.getCanNextPage()" @click="table.nextPage()">
                Next
            </Button>
        </div>
    </div>
</template>
