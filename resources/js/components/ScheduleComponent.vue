<template>
    <div>
        <div class="form-group form-row" v-for="(schedule, index) in schedules">
            <div class="col-11">
                <input
                    type="text"
                    name="schedules[][]"
                    placeholder="Hour (ex: 23:50)"
                    class="form-control"
                    v-model="schedule.hour"
                />
            </div>
            <div class="col-1">
                <button
                    type="button"
                    class="btn btn-danger"
                    @click="removeScehudeule(index)"
                >
                    &times;
                </button>
            </div>
        </div>
        <div class="text-center">
            <button
                type="button"
                class="btn btn-success btn-sm"
                @click="addSchedule"
            >
                Add Schedule
            </button>
        </div>
    </div>
</template>

<script>
export default {
    data: () => ({
        schedules: [],
    }),
    methods: {
        addSchedule() {
            this.schedules.push({
                hour: "",
            });
        },
        removeScehudeule(index) {
            this.schedules.splice(index, 1);
        },
    },
};
</script>
