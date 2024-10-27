import { ref } from 'vue'
import { doGet } from './http'
import get from 'lodash/get'

export function useSettings() {
  const settings = ref({})
  const fetchSettings = async () => {
    const result = await doGet("/api/settings");
    const data = get(result, "data", []);
    for (const datum of data) {
      settings.value[datum.key] = datum.image ? datum.image.url : datum.value
    }
  };
  return {
    settings,
    fetchSettings,
  }
}
