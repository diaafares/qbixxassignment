<template>
    <AdminLayout>
        <Head title="New Client" />

        <div class="w-full py-8 flex justify-center">
            <div class="block p-6 rounded-lg shadow-lg bg-white w-1/3">

                <form method="PUT" @submit.prevent="form.put(`/admin/clients/update/${client.id}`)">
                    <div class="form-group mb-6">
                        <label for="name" class="form-label inline-block mb-2 text-gray-700">
                            Name
                        </label>
                        <input
                            id="name"
                            name="name"
                            type="text"
                            v-model="form.name"
                            placeholder="Enter client name"
                            class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                        >

                        <div v-if="form.errors.name" class="mt-2 font-semibold text-red-500">
                            {{ form.errors.name }}
                        </div>
                    </div>

                    <div v-for="(item,index) in form.items" :key="item.id" class="mb-6">
                        <div class="border-b border-gray-200 mb-2">
                            <nav class="-mb-px flex" aria-label="Tabs">
                                <button v-for="tab in item.tabs" :key="tab.name" type="button" @click="setCurrentTab(item, tab.name)" :class="[tab.current ? 'border-blue-500 text-blue-600' : 'border-transparent text-gray-500 hover:border-gray-300 hover:text-gray-700', 'w-1/3 border-b-2 py-4 px-1 text-center text-sm font-medium']" :aria-current="tab.current ? 'page' : undefined">{{ tab.name }}</button>
                            </nav>
                        </div>

                        <label for="name" class="form-label inline-block mb-2 text-gray-700">
                            Title
                        </label>
                        <input
                            id="name"
                            name="name"
                            type="text"
                            v-model="item.title[activeLanguage(item)]"
                            class="form-control block w-full px-3 py-1.5 text-base font-normal text-gray-700 bg-white bg-clip-padding border border-solid border-gray-300 rounded transition ease-in-out m-0 focus:text-gray-700 focus:bg-white focus:border-blue-600 focus:outline-none"
                        >
                        <div v-if="form.errors[`items.${index}.title.${activeLanguage(item)}`]" class="mt-2 font-semibold text-red-500">
                            {{ form.errors[`items.${index}.title.${activeLanguage(item)}`] }}
                        </div>

                        <label for="paragraph" class="form-label inline-block mb-2 text-gray-700 mt-4">
                            Paragraph
                        </label>
                        <div>
                            <textarea
                                id="paragraph"
                                name="paragraph"
                                rows="3"
                                v-model="item.paragraph[activeLanguage(item)]"
                                class="block w-full rounded border-0 py-1.5 text-gray-700 shadow-sm ring-1 ring-inset ring-gray-300 placeholder:text-gray-400 focus:ring-2 focus:ring-inset focus:ring-blue-600 text-base sm:leading-6"
                            />
                        </div>
                        <div v-if="form.errors[`items.${index}.paragraph.${activeLanguage(item)}`]" class="mt-2 font-semibold text-red-500">
                            {{ form.errors[`items.${index}.paragraph.${activeLanguage(item)}`] }}
                        </div>

                        <label for="type" class="form-label inline-block mb-2 text-gray-700 mt-4">
                            Type
                        </label>
                        <select
                            id="type"
                            name="type"
                            v-model="item.type[activeLanguage(item)]"
                            class="block w-full rounded-md border-0 py-1.5 pl-3 pr-10 text-gray-700 ring-1 ring-inset ring-gray-300 focus:ring-2 focus:ring-blue-600 text-base sm:leading-6"
                        >
                            <option v-for="type in types" :key="type[activeLanguage(item)]" :value="type[activeLanguage(item)]">
                                {{ type[activeLanguage(item)] }}
                            </option>
                        </select>
                        <div v-if="form.errors[`items.${index}.type.${activeLanguage(item)}`]" class="mt-2 font-semibold text-red-500">
                            {{ form.errors[`items.${index}.type.${activeLanguage(item)}`] }}
                        </div>
                    </div>

                    <div class="w-full flex items-end justify-end space-x-8 mt-12">
                        <a
                            href="/admin/clients"
                            title="Return to index"
                            class="inline-block px-6 py-2 leading-tight font-bold focus:outline-none focus:ring-0 transition duration-150 ease-in-out"
                        >
                            Cancel
                        </a>

                        <button type="submit" :disabled="form.processing" class="inline-block px-6 py-2 border-2 bg-blue-600 border-blue-600 text-white leading-tight font-bold rounded hover:bg-blue-500 focus:outline-none focus:ring-0 transition duration-150 ease-in-out">
                            Update Client
                        </button>
                    </div>
                </form>

            </div>
        </div>
    </AdminLayout>
</template>

<script>
    import {useForm} from '@inertiajs/inertia-vue3'
    import AdminLayout from '@/js/Layouts/AdminLayout.vue'

    export default {
        components: {
            AdminLayout,
        },
        props: {
            client: Object,
            types: Object,
        },

        setup(props) {
            const items = props.client.items.map(item => {
                return {
                    id: item.id,
                    title: item.title,
                    paragraph: item.paragraph,
                    type: item.type,
                    tabs: [
                        {
                            name: 'English',
                            language: 'en',
                            current: true,
                        },
                        {
                            name: 'Dutch',
                            language: 'nl',
                            current: false,
                        },
                        {
                            name: 'French',
                            language: 'fr',
                            current: false,
                        }
                    ]
                }
            })

            const setCurrentTab = (item, tabName) => {
                item.tabs.forEach((tab) => {
                    tab.current = tab.name === tabName;
                });
            }

            const activeLanguage = (item) => {
                return item.tabs.filter(tab => tab.current)[0].language
            }

            const form = useForm({
                name: props.client.name,
                items,
            })

            return {
                form,
                setCurrentTab,
                activeLanguage,
            }
        },
    }
</script>
